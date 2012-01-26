<?php require_once("../lib/general/config.php"); ?>

<?php require_once("../lib/scaffold/loadReportConfig.php"); ?>

<?php $index = H::GetPost('index'); ?>
<?php $page = H::GetPost('page')=='' ? '1' : H::GetPost('page'); ?>

<?php if (isset($opciones["Rows"]) && isset($opciones["Rows"][$index]) && isset($opciones["Rows"][$index]['sqlcat'])  && count($opciones["Rows"]) > 0) : ?>

  <?php $rs = $bd->executePager($opciones["Rows"][$index]['sqlcat'],5,$page, $last_page,ADODB_FETCH_ASSOC); ?>

  <?php if($page>$last_page) $page=$last_page; ?>

  <?php if(count($rs)>0) : ?>
    <table id="sortTableExample" class="zebra-striped">
      <thead>
        <tr>
          <?php foreach($rs[0] as $name => $value) : ?>
          <th class="green header"><?php echo ucwords(str_replace('_', ' ', $name)) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach($rs as $register) : ?>
          <tr>
            <?php $col = 0; ?>
            <?php foreach($register as $name => $value) : ?>
              <?php if($col==0) : ?>
                <td><a objCat="<?php echo H::GetPost('obj') ?>" class="selected close" href="#"><?php echo $value ?></a></td>
              <?php else: ?>
                <td><?php echo $value ?></td>
              <?php endif; ?>
              <?php $col++; ?>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <ul>
        <li id="page-previous" class="prev"><a href="javascript:previous(<?php echo "'".H::GetPost('obj')."','".H::GetPost('index')."','".H::GetPost('report')."','".H::GetPost('module')."'"; ?>)">← Anterior</a></li>
        <li id="page-next" class="next"><a href="javascript:next(<?php echo "'".H::GetPost('obj')."','".H::GetPost('index')."','".H::GetPost('report')."','".H::GetPost('module')."'"; ?>)">Siguiente →</a></li>
      </ul>
      <input type="hidden" id="actual-page" value="<?php echo $page ?>">
    </div>
  <?php endif; ?>
<?php else: ?>
<h2>Sin Datos</h2>
<?php endif; ?>
