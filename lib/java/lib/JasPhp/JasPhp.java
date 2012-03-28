package JasPhp;

import java.util.*;
import java.sql.*;
import java.io.*;
import net.sf.jasperreports.engine.JasperReport;
import net.sf.jasperreports.engine.util.JRLoader;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.engine.JRExporter;
import net.sf.jasperreports.engine.JRExporterParameter;
import net.sf.jasperreports.engine.export.JRPdfExporter;
import net.sf.jasperreports.engine.export.JRTextExporter;
import net.sf.jasperreports.engine.export.JRTextExporterParameter;
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


    /***Para calcular la ruta a la que debe apuntar la base del proyecto de reportes***/
    String rutabase = "/";
    File dir = new File(".");
    String ruta = dir.getCanonicalPath();
    java.util.StringTokenizer tokenruta = new StringTokenizer(ruta, "/");
    int ttoken = tokenruta.countTokens();
    for (int i = 0; i < ttoken - 1; i++) {
      rutabase = rutabase + tokenruta.nextToken() + "/";
    }

    /*****Para capturar los parametros de entrada***********/
    String modulo = args[0]; //Módulo
    String nomrep = args[1]; //Reporte
    String rutarep = rutabase + "reports/" + modulo + "/";
    String reportejasper = rutarep + nomrep + ".jasper";
    Random rnd = new Random();

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
    String driver = (String) misima.get("driver");
    String host = (String) misima.get("host");
    String usuario = (String) misima.get("usuario");
    String password = (String) misima.get("password");
    String bd = (String) misima.get("bd");
    String port = (String) misima.get("port");

    /***** Para buscar el archivo con los datos de los parámetros "reporte".yml ******/
    String rutarepyml = rutarep + nomrep + ".yml";
    java.io.File archrepyml = new File(rutarepyml);
    Object objrepyml = new HashMap();
    try {
      objrepyml = (HashMap) Yaml.load(archrepyml);
    } catch (Exception e) {
      System.out.println("Error al Cargar los archivos YML del reporte (reporte.yml). " + e.getMessage().toString());
    }

    Map maparep = (Map) objrepyml;

    Map mirepfila = (Map) maparep.get("Rows");//la letra F debe estar siempre en mayuscula
    Map mirepparam = (Map) maparep.get("Params");//la letra P debe estar siempre en mayuscula

    /*****************FIN***************************/
    String generatxt = (String) mirepparam.get("txt");

    String reportesalida = "";

    Connection connection = null;
    try {
      connection = JasPhp.Conections(driver, host, usuario, password, bd, port, ruta);
      // Ya tenemos el objeto connection creado

      if(connection!=null){
        try {
          JasperReport reporte = (JasperReport) JRLoader.loadObject(reportejasper);

          /***************Parametros del Reprotes*****************/
          Map parameters = new HashMap();
          try {
            //fijos
            String titulo = (String) mirepparam.get("title");

            parameters.put("p_dirbase", rutabase);
            parameters.put("p_title", titulo);
            //parameters.put("SUBREPORT_DIR", rutarep);

            String[][] params = JasPhp.OrderParameters(args);

            String[] name = params[0];
            String[] value = params[1];

            for (int i=0; i<name.length; i++) {
              parameters.put(name[i], value[i]);
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
                reportesalida = "/tmp/reportTXT" + rnd.nextInt() + ".txt";
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
                reportesalida = "/tmp/reportPDF" + rnd.nextInt() + ".pdf";
                exporter.setParameter(JRExporterParameter.OUTPUT_FILE, new java.io.File(reportesalida));
                exporter.exportReport();
              }
            } else {
              JRExporter exporter = new JRPdfExporter();
              exporter.setParameter(JRExporterParameter.JASPER_PRINT, jasperPrint);
              reportesalida = "/tmp/reportPDF" + rnd.nextInt() + ".pdf";
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

  public static java.sql.Connection Conections(String driver, String host, String usuario, String password, String database, String puerto, String ruta)
  {
    String driverClass = "";
    String urljdbc = "";

    if(driver.equals("postgres")){
      driverClass = "org.postgresql.Driver";
      urljdbc = "jdbc:postgresql://" + host + ":" + puerto + "/" + database;
      try {
        Class.forName(driverClass).newInstance();
        return DriverManager.getConnection(urljdbc, usuario, password);
      }
      catch(Exception e){
        System.out.println("Error en conexion a la Base de Datos. " + e.getMessage().toString());
        return null;
      }
    }
    if(driver.equals("sqlite3")) {
      driverClass = "org.sqlite.JDBC";
      urljdbc = "jdbc:sqlite://" + ruta + "/" + database;
      try {
        Class.forName(driverClass).newInstance();
        return DriverManager.getConnection(urljdbc, usuario, password);
      }
      catch(Exception e){
        System.out.println("Error en conexion a la Base de Datos. " + e.getMessage().toString());
        return null;
      }
    }
    if(driver.equals("mysql")) {
      driverClass = "com.mysql.jdbc.Driver";
      urljdbc = "jdbc:mysql://" + host + ":" + puerto + "/" + database;
      try {
        Class.forName(driverClass).newInstance();
        return DriverManager.getConnection(urljdbc, usuario, password);
      }
      catch(Exception e){
        System.out.println("Error en conexion a la Base de Datos. " + e.getMessage().toString());
        return null;
      }
    }
    if(driver.equals("oracle")) {
      driverClass = "org.postgresql.Driver";
      urljdbc = "jdbc:postgresql://" + host + ":" + puerto + "/" + database;
      try {
        Class.forName(driverClass).newInstance();
        return DriverManager.getConnection(urljdbc, usuario, password);
      }
      catch(Exception e){
        System.out.println("Error en conexion a la Base de Datos. " + e.getMessage().toString());
        return null;
      }
    }else return null;

  }

  public static String[][] OrderParameters(String[] params)
  {
    String[] p = new String[(params.length/2)-1];
    String[] v = new String[(params.length/2)-1];

    int ii=0;
    for(int i=2; i<params.length; i=i+2){
      p[ii] = params[i];
      v[ii] = params[i+1];
      ii++;
    }

    String[][] order_p = {p,v};

    return order_p;
  }

}
