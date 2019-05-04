<?
error_reporting(E_ALL &~ E_NOTICE);
ini_set('display_errors','On');

//$work_dir = 'data';

include('MooSQL/Client.php');

// an example of using database

session_start();

header('content-type: text/html; charset="UTF-8"');

if($work_dir) $_SESSION['work_dir'] = $work_dir;

if(isset($_GET['change_work_dir'])) unset($_SESSION['work_dir']);
if(isset($_POST['work_dir'])) $_SESSION['work_dir'] = $_POST['work_dir'];

if(!isset($_SESSION['work_dir']))
{
	?>
	Work directory: <form action="<?=$_SERVER['PHP_SELF']?>" method="POST"><input name="work_dir">&nbsp;<input type="submit" value="go!"></form>
	<?
	
	die();
}

$db = new YNDb($_SESSION['work_dir']);

echo 'Work directory: <b>'.$_SESSION['work_dir'].'</b><br><br>';

?>

<table width="100%">
	<tr>
		<td valign="top" nowrap="nowrap"><b>Tables:</b><br><br>
			<?
			$dh = opendir($_SESSION['work_dir']);
			while(false!==($f = readdir($dh)))
			{
				if(strlen($f) <= 3) continue;
			
				if(substr($f, -4) == '.str') echo '<a href="?act=open&table='.rawurlencode(substr($f,0,-4)).'">'.substr($f,0,-4).'</a><br>';
			}
			closedir($dh);
			?>
		
			<br><b><a href="?act=create-table">Create new table</a></b>
		</td>
		
		<td valign="top" width="100%">
			<?
			$wd = $_SESSION['work_dir'];
			
			switch($_GET['act'])
			{
			default:
				echo 'Choose table';
				break;
			case 'create-table':
			
				?>
				
				<h3>Table creation</h3>
				
				<style>
				table.border tbody tr td, table.border thead tr th { border: 1px gray solid; padding: 3px; margin: 0px; }
				</style>
				
				<form action="?act=apply-create-table" method="POST">
				
				Table name: <input name="table" value="some_table<?=mt_rand()?>"><br><br>
				
				<table class="border" cellspacing="0">
					<thead>
					<tr>
						<th>Column name</th>
						<th>Type</th>
						<th>Indexes</th>
					</tr>
					</thead>
					<tbody>
					
					<tr>
						<td><input name="name[]" value="id"></td>
						<td>INT<input type="hidden" name="type[]" value="INT"></td>
						<td>PRIMARY KEY; AUTO_INCREMENT<input type="hidden" name="index[]" value="AUTO_INCREMENT"></td>
					</tr>
					
					<? for($i = 1; $i <= 10; $i++) { ?>
						
						<tr>
							<td><input name="name[]"></td>
							<td><select name="type[]"><?foreach(explode(' ','BYTE INT TINYTEXT TEXT LONGTEXT DOUBLE') as $v) echo '<option value="'.$v.'">'.$v.'</option>';?></select></td>
							<td><input type="radio" name="index[<?=$i?>]" value="INDEX"> INDEX &nbsp;&nbsp;&nbsp;<input type="radio" name="index[<?=$i?>]" value="UNIQUE"> UNIQUE &nbsp;&nbsp;&nbsp;<input type="radio" name="index[<?=$i?>]" value="" checked="checked"> NO INDEX</td>
						</tr> 
						
					<? } ?>
					
					</tbody>
					
				</table>
				
				<br><br><button type="submit"><b>create</b></button>
				
				</form>
				
				<?
				break;
			case 'apply-create-table':
			
				echo '<pre>',!print_r($_POST),'</pre>';
				
				$fields = array();
				$params = array( 'AUTO_INCREMENT' => '', 'INDEX' => array(), 'UNIQUE' => array() );
				
				foreach($_POST['name'] as $idx=>$v)
				{
					if(empty($v)) { unset($_POST['name'][$idx]); continue; }
					
					$fields[$v] = $_POST['type'][$idx];
					
					$index = $_POST['index'][$idx];
					
					if($index == 'AUTO_INCREMENT')              $params['AUTO_INCREMENT'] = $v;
					if($index == 'INDEX' || $index == 'UNIQUE') $params[$index][] = $v;
				}
				
				if($db->create($_POST['table'], $fields, $params)) echo 'Table created successfully. <br><br><a href="?act=open&table='.rawurlencode($_POST['table']).'">open table</a>';
				else echo 'Could not create table: '.$db->get_error();
				
				break;
			case 'open':
				
				$tbl = $_GET['table'];
				
				list($fields, $params, ) = unserialize(file_get_contents($wd.'/'.$tbl.'.str'));
				
				@$index = $params['INDEX'];
				@$unique = $params['UNIQUE'];
				$aname = $params['AUTO_INCREMENT']['name'];
				
				?>
				
				<h3><a href="?act=delete-table&amp;table=<?=$tbl?>" onclick="return (confirm('Really delete table?'));" style="color:red;text-decoration:none;"><b>(delete)</b></a> <?=$_GET['table']?></h3>
				
				<table border=1><tr><th>Column name</th><th>Type</th><th>Indices</th></tr>
					
					<? foreach($fields as $name=>$type) { ?>
						
						<tr>
							<td <?if($name == $aname) echo 'style="text-decoration: underline;"';?>><?=$name?></td>
							<td><?=$type?></td>
							<td>
							<?
								if(in_array($name, $index)) echo 'INDEX';
								if(in_array($name, $unique)) echo 'UNIQUE';
								if($name == $aname) echo 'PRIMARY; AUTO_INCREMENT';
							 ?>
							</td>
						</tr>
					<? } ?>
				
				</table>
				
				<hr>
				
				<table style="margin-top: 10px;">
					<tr><td><b>Auto_increment value:</b></td><td><?=$params['AUTO_INCREMENT']['cnt']?></td></tr>
					<tr><td><b>Data file:</b></td><td><?=round(filesize($wd.'/'.$tbl.'.dat')/1024/1024,2)?> Mb</td></tr>
					<tr><td><b>PRIMARY index file:</b></td><td><?=round(filesize($wd.'/'.$tbl.'.pri')/1024,2)?> Kb</td></tr>
					<? if(file_exists($f = $wd.'/'.$tbl.'.btr')){ ?><tr><td><b>B-TREE index file:</b></td><td><?=round(filesize($f)/1024,2)?> Kb</td></tr><?}?>
					<? if(file_exists($f = $wd.'/'.$tbl.'.idx')){ ?><tr><td><b>List index file:</b></td><td><?=round(filesize($f)/1024,2)?> Kb</td></tr><?}?>
				</table>
				
				<?
				
				if(!isset($_REQUEST['custom']))
				{
					$_REQUEST['cond'] = array( array($aname, 'IN', range(1,30)) );
					$_REQUEST['limit'] = array(0, 30);
				}else
				{
					if($_REQUEST['cond'][0][1] == 'IN') $_REQUEST['cond'][0][2] = explode(',',$_REQUEST['cond'][0][2]);
				}
				?>
				<hr>
				<h3>Records:</h3>
				
				<form action="?act=open&amp;table=<?=rawurlencode($tbl)?>" method="POST">
					Condition:
						<select name="cond[0][0]"><?foreach($fields as $name=>$type) echo '<option name="'.htmlspecialchars($name).'" '.($_REQUEST['cond'][0][0] == $name ? 'selected="selected"' : '').'>'.htmlspecialchars($name).'</option>'; ?></select>
						
						<select name="cond[0][1]"><?foreach(explode(' ','= > < IN') as $op) echo '<option name="'.htmlspecialchars($op).'" '.($_REQUEST['cond'][0][1] == $op ? 'selected="selected"' : '').'>'.htmlspecialchars($op).'</option>';?></select>
						
						<input name="cond[0][2]" size=20 value="<?=($_REQUEST['cond'][0][1] == 'IN' ? htmlspecialchars(implode(',',$_REQUEST['cond'][0][2])) :  htmlspecialchars($_REQUEST['cond'][0][2]) )?>">
						
						<br>
					Limits: <input name="limit[0]" size=3 value="<?=$_REQUEST['limit'][0]?>">,<input name="limit[1]" size=3 value="<?=$_REQUEST['limit'][1]?>"><br>
					
					<input type="submit" name="custom" value="select">
				</form>
				
				<?
				$start=microtime(true);
				$res = $db->select($tbl, array('cond' => $_REQUEST['cond'], 'limit' => $_REQUEST['limit']));
				echo 'Select performed for '.round(microtime(true)-$start,5).' sec<br><br>';
				?>
				
				<table border=1>
				
				<tr><th></th><?foreach($fields as $name=>$type){echo'<th>'.htmlspecialchars($name).'</th>';}?></tr>
				
				<?
				foreach($res as $row)
				{
					echo '<tr>';
					
					echo '<td><a href="?act=delete-row&amp;field='.rawurlencode($aname).'&amp;'.rawurlencode($aname).'='.$row[$aname].'&amp;table='.$tbl.'" onclick="return (confirm(\'Delete row?\'));" style="color:red;text-decoration:none;"><b>×</b></a></td>';
					
					foreach($row as $v)
					{
						if(strlen($v) > 100) $v = substr($v,0,100).'...';
						
						echo '<td>'.wordwrap(htmlspecialchars($v),75,'&shy;').'</td>';
					}
					echo '</tr>';
				} ?>
				
				</table>
				
				<hr>
				
				<h3>Add new row:</h3>
				
				<form action="?act=add-new&amp;table=<?=rawurlencode($tbl)?>" method="POST">
					
					<table>
						
						<?foreach($fields as $name=>$type) { ?>
							<tr><td><?=htmlspecialchars($name)?></td><td><? if(strpos($type, 'TEXT')!==false) { echo '<textarea name="'.htmlspecialchars($name).'" style="width:100%; height: 80px;""></textarea>'; }else{ echo '<input name="'.htmlspecialchars($name).'" style="width: 100%;">'; } ?></td></tr>
						<? }?>
						
					</table>
					
					<br>
					
					<button type="submit"><b>add</b></button>
					
				</form>
				
				<?
				break;
				
			case 'add-new':
			
				$tbl = $_GET['table'];
				
				list($fields, $params, ) = unserialize(file_get_contents($wd.'/'.$tbl.'.str'));
				
				@$index = $params['INDEX'];
				@$unique = $params['UNIQUE'];
				$aname = $params['AUTO_INCREMENT']['name'];
				
				if($_POST[$aname] === '') unset($_POST[$aname]);
				
				if($db->insert($tbl, $_POST)) echo 'Record added successfully. Auto increment value: '.$db->insert_id();
				else echo 'Row add error: '.$db->get_error();
				
				echo '<br><br><a href="javascript:history.back();">Go back</a>';
				
				break;
			case 'delete-row':
				
				if($res = $db->delete($_GET['table'], array('cond' => $_GET['field'].' = '.intval($_GET[$_GET['field']])))) echo 'Record deleted.';
				else echo 'Error when deleting record: '.$db->get_error();
				
				echo '<br><br><a href="javascript:history.back();">Go back</a>';
				
				break;
			case 'delete-table':
				
				chdir($wd);
				
				$tbl = $_GET['table'];
				
				$dh = opendir('.');
				
				while(false!==($f=readdir($dh)))
				{
					if(substr($f,0,strlen($tbl)+1) == $tbl.'.' && strlen($f) == strlen($tbl)+4) unlink($f);
				}
				
				closedir($dh);
				
				echo 'If you see no errors, that means that the table was deleted successfully.';
				
				break;
			}
			?>
		</td>
	</tr>
</table>