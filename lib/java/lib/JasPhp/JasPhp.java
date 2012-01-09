package JasPhp;

import java.awt.HeadlessException;
import java.util.*;
import java.sql.*;
import java.io.*;
import net.sf.jasperreports.engine.JRException;
import net.sf.jasperreports.engine.JasperReport;
import net.sf.jasperreports.engine.util.JRLoader;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.engine.JRExporter;
import net.sf.jasperreports.engine.JRExporterParameter;
import net.sf.jasperreports.engine.export.JRPdfExporter;
import net.sf.jasperreports.engine.export.JRTextExporter;
import net.sf.jasperreports.engine.export.JRTextExporterParameter;
import nickyb.sqleonardo.environment.mdi.MDIActions.Exit;
import org.ho.yaml.Yaml;

/**
 *
 * @author cramirez
 */
public class JasPhp {

  /**
   * @param args the command line arguments
   */
  public static void main(String[] args) throws IOException {

    //String args1[]={"SIMA059","hacienda","fcractcom","10","21801","2011","0.00","100.00"};

    // TODO code application logic here
    /***Para calcular la ruta a la que debe apuntar la base del proyecto de reportes***/
    String rutabase = "/";
    File dir = new File(".");
    String ruta = dir.getCanonicalPath();
    java.util.StringTokenizer tokenruta = new StringTokenizer(ruta, "/");
    int ttoken = tokenruta.countTokens();
    for (int i = 0; i < ttoken - 2; i++) {
      rutabase = rutabase + tokenruta.nextToken() + "/";
    }
    //rutabase = "/home/cidesa/www/carora/reportes/"; //comentar esta linea es para pruebas desde el netbean

    /******FIN********/
    /*****Para capturar los parametros de entrada***********/
    //String schema = "SIMA059"; //Para pruebas colocar valores fijos ejemplo
    //String modulo = "hacienda"; //Para pruebas colocar valores fijos ejemplo
    //String nomrep = "fcractcom"; //Para pruebas colocar valores fijos ejemplo
    //String schema = args[0]; //Para pruebas colocar valores fijos ejemplo String schema = "SIMA001"
    String modulo = args[0]; //Para pruebas colocar valores fijos ejemplo String modulo = "licitaciones"
    String nomrep = args[1]; //Para pruebas colocar valores fijos ejemplo String nomrep = "lirprebas"
    String rutarep = rutabase + "reports/" + modulo + "/";
    String reportejasper = rutarep + nomrep + ".jasper";
    Random rnd = new Random();

    /*****************FIN***************************/
    /*****Para buscar en el archivo databases.yml los datos de la conexion******/
    String rutayml = rutabase + "config/databases.yml";
    java.io.File archdbyml = new File(rutayml);
    Object objetobdyml = new HashMap();
    try {
      objetobdyml = (HashMap) Yaml.load(archdbyml);
    } catch (Exception e) {
      System.out.println("Error al Cargar los archivos YML del reporte (Database). " + e.getMessage().toString());
    }
    Map mapabd = (Map) objetobdyml;

    Map midb = (Map) mapabd.get("database");
    String midbname = (String) midb.get("name");

    Map misima = (Map) mapabd.get(midbname);
    String mihost = (String) misima.get("host");
    String miusuario = (String) misima.get("usuario");
    String mipassword = (String) misima.get("password");
    String mibd = (String) misima.get("bd");
    Integer miport = (Integer) misima.get("port");
    /*****************FIN***************************/
    /*****Para buscar en el archivo databases.yml los datos de la conexion******/
    String rutarepyml = rutarep + nomrep + ".yml";
    java.io.File archrepyml = new File(rutarepyml);
    Object objrepyml = new HashMap();
    try {
      objrepyml = (HashMap) Yaml.load(archrepyml);
    } catch (Exception e) {
      System.out.println("Error al Cargar los archivos YML del reporte (reporte.yml). " + e.getMessage().toString());
    }

    Map maparep = (Map) objrepyml;

    Map mirepfila = (Map) maparep.get("Filas");//la letra F debe estar siempre en mayuscula
    Map mirepparam = (Map) maparep.get("Parametros");//la letra P debe estar siempre en mayuscula

    /*****************FIN***************************/
    /********Configuracion del Conexion*************/
    String host = mihost;
    String usuario = miusuario;
    String password = mipassword;
    String database = mibd;
    String puerto = miport.toString();
    String driver = "org.postgresql.Driver";
    String ulrjdbc = "jdbc:postgresql://" + host + ":" + puerto + "/" + database;
    /*****************FIN***************************/
    String generatxt = (String) mirepparam.get("generatxt");

    String reportesalida = "";



    Connection connection = null;
    try {
      Class.forName(driver).newInstance();
      connection = DriverManager.getConnection(ulrjdbc, usuario, password);
      // Ya tenemos el objeto connection creado

      try {
        JasperReport reporte = (JasperReport) JRLoader.loadObject(reportejasper);

        /***************Parametros del Reprotes*****************/
        Map parameters = new HashMap();
        try {
          //fijos
          String titulo = (String) mirepparam.get("titulo");

          //parameters.put("p_schema", "\"" + schema + "\"");
          parameters.put("p_dirbase", rutabase);
          parameters.put("p_titulo", titulo);
          parameters.put("SUBREPORT_DIR", rutarep);
          //dinamicos
          //ESTA LECTURA DEL YML DEBE VENIR ORDENADA
          Integer r = 3;
          for (Iterator it = mirepfila.values().iterator(); it.hasNext();) {
            Object tiracompleta = (HashMap) it.next();
            Map mapatira = (Map) tiracompleta;
            if (mapatira.containsKey("nomdes")) {
              String caja1 = mapatira.get("nomdes").toString();
              if (!"".equals(caja1)) {
                parameters.put(caja1, args[r]);
                r++;
              }
            }
            if (mapatira.containsKey("nomhas")) {
              String caja2 = mapatira.get("nomhas").toString();
              if (!"".equals(caja2)) {
                parameters.put(caja2, args[r]);
                r++;
              }
            }
          }
        } catch (Exception e) {
          System.out.println("No se Pudo realizar la carga y pase de parametros. " + e.getMessage().toString());
        }
        /*****************FIN***************************/
        try {
          JasperPrint jasperPrint = JasperFillManager.fillReport(reporte, parameters, connection);
          if (!(generatxt==null)) {
            if (generatxt.compareTo("S") == 0) {
              JRExporter exporter = new JRTextExporter();
              exporter.setParameter(JRExporterParameter.JASPER_PRINT, jasperPrint);
              reportesalida = "/tmp/reportePDF" + rnd.nextInt() + ".txt";
              exporter.setParameter(JRExporterParameter.IGNORE_PAGE_MARGINS, true);
              exporter.setParameter(JRExporterParameter.OUTPUT_FILE, new java.io.File(reportesalida));
              exporter.setParameter(JRTextExporterParameter.CHARACTER_WIDTH, new Float(12));
              exporter.setParameter(JRTextExporterParameter.CHARACTER_HEIGHT, new Float(12));
              exporter.setParameter(JRTextExporterParameter.IGNORE_PAGE_MARGINS, true);
              exporter.setParameter(JRTextExporterParameter.BETWEEN_PAGES_TEXT, "");
              exporter.setParameter(JRTextExporterParameter.LINE_SEPARATOR, "\n");
              exporter.exportReport();
            } else {
              JRExporter exporter = new JRPdfExporter();
              exporter.setParameter(JRExporterParameter.JASPER_PRINT, jasperPrint);
              reportesalida = "/tmp/reportePDF" + rnd.nextInt() + ".pdf";
              exporter.setParameter(JRExporterParameter.OUTPUT_FILE, new java.io.File(reportesalida));
              exporter.exportReport();
            }
          } else {
            JRExporter exporter = new JRPdfExporter();
            exporter.setParameter(JRExporterParameter.JASPER_PRINT, jasperPrint);
            reportesalida = "/tmp/reportePDF" + rnd.nextInt() + ".pdf";
            exporter.setParameter(JRExporterParameter.OUTPUT_FILE, new java.io.File(reportesalida));
            exporter.exportReport();
          }


          System.out.println(reportesalida);
        } catch (net.sf.jasperreports.engine.JRException e) {
          if(e.getCause()==null) System.out.println(e.getMessage().toString());
          else System.out.println(e.getCause().getMessage().toString());
        } catch (Exception e) {
          if(e.getCause()==null) System.out.println(e.getMessage().toString());
          else System.out.println(e.getCause().getMessage().toString());
        }

      } catch (Exception e) {
          if(e.getCause()==null) System.out.println("No se Puede Generar el Reporte no existe el fichero. " + e.getMessage().toString());
          else System.out.println("No se Puede Generar el Reporte no existe el fichero. " + e.getCause().getMessage().toString());
      }

    } catch (Exception e) {
      System.out.println("No hay conexion a la Base de Datos. " + e.getMessage().toString());
    } finally {
      if (connection != null) {
        try {
          connection.close();
        } catch (SQLException e) {
        }
      }
    }
  }
}
