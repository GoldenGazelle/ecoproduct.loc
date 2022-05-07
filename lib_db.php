<?php   
/*Переводим данные в массив*/
function dataBaseToArray($resultat)
{
    $array = array();
    while($row = mysql_fetch_assoc($resultat))
	{
        $array[] = $row;
    }
    return $array;
}

/*Возвращение все новости*/
function selectNew()
{
    $sql = "SELECT *, DATE_FORMAT(date, '%d.%m.%Y') AS date_format FROM news ORDER BY date";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Авторизация пользователя в панели администратора сайта*/
function enter($login, $password)
{
	$resultat = '';
	if ($login == '') 
	{
		unset($login);
		$resultat = '<br>Введите пожалуйста логин';
	}
	else
	{
		if ($password == '') 
		{
			unset($password);
			$resultat = '<br>Введите пароль';
		}
		else
		{
			$login = stripslashes($login);
			$login = htmlspecialchars($login);
			$password = stripslashes($password);
			$password = htmlspecialchars($password);
			
			$login = trim($login);
			$password = trim($password);
            //$password = md5($password);
			$q = "SELECT  * FROM  admin WHERE  login = '$login' AND  password = '$password'";
			$user = mysql_query($q);;
			$id_user = mysql_fetch_array($user, MYSQL_ASSOC);
				
			if (empty($id_user['id']))
			{
				$resultat = '<br>Извините, введённый вами логин или пароль неверный.<br>Вход в панель администратора невозможен!';
			}
			else 
			{
				$_SESSION['password'] = $password; 
				$_SESSION['login'] = $login; 
				$_SESSION['id'] = $id_user['Key'];	
				$resultat = '<br>Вы успешно прошли авторизацию';
			}
		}
	}
	return $resultat;
}

/*Возвращение каталога типов ТС*/
function getTypeTS()
{
    $sql = "SELECT * FROM typets ORDER BY type";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Возвращение каталога регионов приемки и отправки*/
function getRegion()
{
    $sql = "SELECT * FROM region ORDER BY region";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Возвращение каталога маршрута*/
function getRoute($s)
{
    $sql = "SELECT route.id, route.dist, route.time, route.idpoint1 , route.idpoint2, route.idtypets,
			point_1.point AS point1, 
			point_2.point AS point2,
			typets.type
			FROM route, typets, points AS point_1, points AS point_2
			WHERE 
			route.idtypets = typets.id AND 
			route.idpoint1 =  point_1.id AND
			route.idpoint2 =  point_2.id "
			.$s."
			ORDER BY 
			typets.type, point1, point2";
    
	$resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function getCityName($id)
{
    $sql = "SELECT point FROM points WHERE id = $id";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/* Получаем дистанцию между двумя пунктами */
function getDist($point1, $point2)
{
    $sql = "SELECT dist FROM route WHERE idpoint1 = $point1 AND idpoint2 = $point2";
    $resultat = mysql_query($sql) or die(mysql_error());

    return dataBaseToArray($resultat);
}

/* Проверяем есть ли попутный груз */
function checkPassingCargo() {

}

/*Возвращение каталога городов приемки и отправки*/
function getPoint()
{
    $sql = "SELECT points.id, points.point, region.region 
		FROM points, region
		WHERE points.idregion = region.id
		ORDER BY point";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Фильтрация полученных данных*/
function clearData($data, $type = "s")
{
    switch($type)
	{
        case "s": return mysql_real_escape_string(trim(strip_tags($data))); break;
        case "i": return (int)$data;
        case "f": return (float)$data;
        case "string_file": return trim(strip_tags($data));
    }
}

/*Удаление данных из таблицы*/
function deleteTable($id, $table){
    $sql = "DELETE FROM $table WHERE id=$id";
    mysql_query($sql) or die(mysql_error());
}

/*Получение списка закаов*/
function getOrders($number, $s)
{
	$sql = "SELECT orders.*, typets.type,
			DATE_FORMAT(orders.date, '%d.%m.%Y') AS date_format, 
			DATE_FORMAT(orders.date2, '%d.%m.%Y') AS date_format2,
			point_1.point AS point1, point_2.point AS point2
			FROM orders,typets,points AS point_1, points AS point_2
			WHERE
			orders.idtypets = typets.id AND 
			orders.idpoint1 =  point_1.id AND
			orders.idpoint2 =  point_2.id";
	
	if ($number <> '') $sql .= " AND orders.number = $number";	
	if ($s <> '') $sql .= $s;
	
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);	
}

function getActiveOrders()
{
    $sql = "SELECT id, idpoint1 FROM orders WHERE number IS NOT NULL";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function getUnActiveOrders()
{
    $sql = "SELECT id, idpoint1 FROM orders WHERE number IS NULL";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}
// TODO: логику поменять
function getPassingCitiesById($id)
{
    $sql = "SELECT id_points FROM route WHERE idpoint1 = $id";

    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function setOrderNumber($id, $number)
{
    $sql = "UPDATE orders SET number = $number WHERE id = $id";

    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Поиск данных истории движения по номеру накладной и вывод*/
function findNumber($number, $idorder)
{
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
				
	$resultat = '';
	if ($number == '' and $idorder == 0) 
	{
		unset($number);
		echo "<br>Введите пожалуйста номер";
	}
	else
	{					
		$ss = '';
		if ($idorder > 0) $ss = ' AND orders.id = '.$idorder;
		$orderss = getOrders($number, $ss);		
		$error = 0;
		
		foreach($orderss as $order)
		{
			$error = 1;?>
			
			<h3>Дата заказа: <?=$order["date_format"]?></h3>	
			<h3>№ накладной: <?=$order["number"]?></h3>
			<h3>Пункт отправления: <?=$order["point1"]?></h3>
			<h3>Пункт назначения: <?=$order["point2"]?></h3>
			<hr><h3>Заказчик: <?=$order["fio"]?></h3>
			<h3>Адрес доставки: <?=$order["address"]?></h3>
			<h3>Контакты: <?=$order["phone"]?></h3>
				
			<?				
			$sql = "SELECT  orderst.id, 
				orderst.date,
				DATE_FORMAT(date, '%d.%m.%Y') AS date_format, 					
				points.point
				FROM orderst, points
				WHERE orderst.idpoint =  points.id AND
				idorder = $order[id]";				
			$ordersts = mysql_query($sql) or die(mysql_error());
			$orderstss = dataBaseToArray($ordersts);?>
			
			<hr><table border="1" cellpadding="0" cellspacing="0" width="100%">		
			<tr>
			<td><b># п/п</td>
			<td><b>Пункт назначения</td>					
			<td><b>Дата прибытия</td>
			</tr>
				
			<tr>
			<td>1</td>
			<td><?=$order["point1"]?></td>					
			<td><?=$order["date_format"]?></td>
			</tr>
			
			<?
			$i = 1;
			foreach($orderstss as $orderst)
			{
				$i++;?>					
				<tr>	
				<td><?=$i?></td>					
				<td><?=$orderst["point"]?></td>					
				<td><?=$orderst["date_format"]?>
				<?
				if($orderst["date"] == '') {
				if (empty($login) or empty($password)) {} 
				else {?>
				<a href="order_date.php?id=<?=$orderst["id"]?>&number=<?=$order["number"]?>"><img src="images/edit.ICO" alt="date" /></a>
				<?}}?></td>
				</tr>
			<?
			}
			$i++;?>
			
			<tr>
			<td><?=$i?></td>
			<td><?=$order["point2"]?></td>
			<td><?=$order["date_format2"]?>
			<?
				if($order["date_format2"] == '') {
				if (empty($login) or empty($password)) {} 
				else {?>
				<a href="order_date2.php?id=<?=$order["id"]?>&number=<?=$order["number"]?>"><img src="images/edit.ICO" alt="date" /></a>
				<?}}?></td>			
			</tr>
				
			</table>
		<?
		}
		if ($error == 0)
			echo '<br>Извините, введённый Вами номер накладной не существует.<br>Уточните данные у Вашего менеджера по <a href=contact.php>телефонам</a>!';				
	}
}

/*Добавляем заявку на доставку продуктов*/
function addOrder($date, $fio, $phone, $idpoint2, $ul, $house)
{
    $idpoint1 = getRegionCenter($idpoint2);
	$sql = "INSERT INTO orders(
        date,
        fio,
        phone,
        idtypets,
        idpoint1,
        idpoint2,
        ul,
        house)
    VALUES(
        '$date',
		'$fio',			
		'$phone',
           1,
        $idpoint1,
		$idpoint2,
           '$ul',
           $house
        )";
	mysql_query($sql) or die(mysql_error());

	// Определяем идентификатор последней добавленной записи в этой таблице 
	$latest_id = mysql_insert_id();	
	$goods = myBasket();
	foreach($goods as $item)
	{
        $sql = "INSERT INTO ordersp(
                orderid,
                goodsid,
                quantity)
            VALUES(
                $latest_id ,
                '$item[catalogid]',
                '$item[quantity]')";
		mysql_query($sql) or die(mysql_error());
	}

	/*Запрос на удаление товаров из корзины*/
	$sql = "DELETE FROM basket WHERE customer='".session_id()."'";
	mysql_query($sql) or die(mysql_error());		
}

/*Определение областного центра города, в который идет заказ*/
function getRegionCenter($idpoint)
{
    $sql = "SELECT *
            FROM points
            WHERE idregion
            IN (SELECT idregion
            FROM points
            WHERE id =$idpoint)
            AND is_region_center = TRUE";
    $resultat = mysql_query($sql) or die(mysql_error());
    $res = mysql_fetch_array($resultat, MYSQL_ASSOC);
    return $res['id'];
}

/*Получение стоимости заказа на доставку*/
function calc($idtypets, $idpoint1, $idpoint2)
{
    $sql = "SELECT MIN(route.dist * typets.price) AS minP, 
			route.time
			FROM route, typets 
			WHERE 
            typets.id = route.idtypets AND
			route.idtypets=$idtypets AND
			route.idpoint1=$idpoint1 AND
			route.idpoint2=$idpoint2";
    $resultat = mysql_query($sql) or die(mysql_error());
    $res = mysql_fetch_array($resultat, MYSQL_ASSOC);

    if($res['minP'] == 0)
	{
	    $sql = "SELECT MIN(route.dist * typets.price) AS minP, 
			route.time 
			FROM route, typets 
			WHERE 
            typets.id = route.idtypets AND
			route.idtypets=$idtypets AND
			route.idpoint1=$idpoint2 AND
			route.idpoint2=$idpoint1";
		$resultat = mysql_query($sql) or die(mysql_error());
		$res = mysql_fetch_array($resultat, MYSQL_ASSOC);
	}

	return $res;
}

/*Исполнение заказа по срокам*/
function orderDate($id){
	$date = date('Y:m:d');
	$sql = "UPDATE orderst
			SET date = '$date'
			WHERE id=$id";
	mysql_query($sql) or die(mysql_error());
}

/*Исполнение заказа по срокам конец*/
function orderDate2($id){
	$date = date('Y:m:d');
	$sql = "UPDATE orders
			SET date2 = '$date'
			WHERE id=$id";
	mysql_query($sql) or die(mysql_error());
}

/*---Получение информации о купленных товарах в заказах---*/
function getOrdersT($orderid)
{
    $sql = "SELECT * FROM ordersp, catalog 
			WHERE 
            catalog.id = ordersp.goodsid AND
			orderid=$orderid";
			
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

/*Поиск данных истории движения по номеру накладной и вывод формы редактирования*/
function findNumber2($number, $idorder)
{
	$login = $_SESSION['login'];
	$password = $_SESSION['password'];
				
	$resultat = '';
	if ($number == '' and $idorder == 0) 
	{
		unset($number);
		echo "<br>Введите пожалуйста номер";
	}
	else
	{					
		$ss = '';
		if ($idorder > 0) $ss = ' AND orders.id = '.$idorder;
		$orderss = getOrders($number, $ss);		
		$error = 0;
		
		foreach($orderss as $order)
		{
			$error = 1;?>			
			
			<form action="add_nakl.php" method="POST">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td><h3>№ накладной: <input type='text' name='nakl' style='width:129px' value=<?=$order['number']?>>
			<a href="add_nakl.php?id=<?=$idorder?>"><input type="submit" value="ОК" name="submit"></a></td>
			<td><h3>Дата заказа: <?=$order['date_format']?></td></tr>			
			<tr><td><h3>Пункт отправления: <?=$order['point1']?></td>			
			<td><h3>Пункт назначения: <?=$order['point2']?></td></tr>				
			<tr><td><h3>Заказчик: <?=$order["fio"]?></td>
			<td><h3>Контакты: <?=$order["phone"]?></td></tr>
<!--			<tr><td><h3>Адрес доставки: --><?//=$order["address"]?><!--</h3></td></tr>		-->
			<input type="hidden" value="<?=$order[id]?>" name="idorder">
			<input type="hidden" value="<?=$order['point1']?>" name="point1">
			<input type="hidden" value="<?=$order['point2']?>" name="point2">
			</table>
			</form>
			
			<table border="1" cellpadding="3" cellspacing="0" width="100%">		
			<tr>
				<td></td>
				<td><h4>Артикул</h4></td>
				<td><h4>Товар</h4></td>																		
				<td><h4>Количество</h4></td>	
				<td><h4>Цена</h4></td>	
			</tr>

			<?
			$ii = 0;
			$orderst = getOrdersT($order["id"]);					
			foreach($orderst as $item){
				$ii++;
				$sum += $item["quantity"] * $item["price"] ?>						
				<tr><td><?=$ii?></td>								
				<td><?=$item["article"]?></td>
				<td><?=$item["name"]?></td>										
				<td><?=$item["quantity"]?>у.е.</td>
				<td><?=$item["price"]?>р.</td>	
				</tr>					
				<?
			}

			echo "</table>";				
							
			$sql = "SELECT  orderst.id, 
				orderst.date,
				DATE_FORMAT(date, '%d.%m.%Y') AS date_format, 					
				points.point
				FROM orderst, points
				WHERE orderst.idpoint =  points.id AND
				idorder = $order[id]";				
			$ordersts = mysql_query($sql) or die(mysql_error());
			$orderstss = dataBaseToArray($ordersts);?>

            </table>
<!---->
<!--			<form action="add_orderst.php" method="POST">-->
<!--			<hr><table border="0" cellpadding="0" cellspacing="0" width="100%">	-->
<!--			<input type="hidden" value="--><?//=$order[id]?><!--" name="idorder">			-->
<!--			<tr><td width=37><b># п/п</td>-->
<!--			<td><b>Пункт назначения</td><td></td><tr>-->
<!--				-->
<!--			<tr><td>1</td><td>--><?//=$order["point1"]?><!--</td></tr>-->
<!--			-->
<!--			--><?//
//			$i = 1;
//			foreach($orderstss as $orderst)
//			{
//				$i +=1;?><!--					-->
<!--				<tr>	-->
<!--				<td>--><?//=$i?><!--</td>-->
<!--				<td>--><?//=$orderst["point"]?><!--</td>-->
<!--				<td><a href="delete_points.php?idorder=--><?//=$order[id]?><!--&idorderst=--><?//=$orderst[id]?><!--"><img src="images/del.ICO" alt="del" /></a></td>-->
<!--				</tr>-->
<!--			--><?//
//			}
//			$i++;?>
<!--			-->
<!--			<tr>-->
<!--			<td>--><?//=$i?><!--</td>-->
<!--			<td>--><?//=$order["point2"]?><!--</td>		-->
<!--			</tr>		-->
<!--			-->
<!--		    <tr><td></td>		    -->
<!--			<td><select name='pointnew' size='1' style='width:170px;'>-->
<!--				<option value='vse'>Выберите из списка</option>-->
<!--				--><?//$points = getPoint();  //строка для добавления записи
//				foreach($points as $item){
//					echo "<option value='".$item['id']."'>".$item['point']."</option>";
//				}?>
<!--				</select><a href="add_orderst.php?id=--><?//=$idorder?><!--"><input type="submit" value="ОК" name="submit"></a></td></tr>				-->
<!--			</table>-->
<!--			</form>-->
<!--		--><?//
		}
//		if ($error == 0)
//			echo '<br>Извините, введённый Вами номер накладной не существует!';
	}
}

/*Добавляем новый пункт маршрута по доставке продуктов*/
function addOrderst($idorder, $pointnew)
{    		
	if ($idorder <>0 and $pointnew<>0)
	{
		$sql = "INSERT INTO orderst( 
			idorder,
			idpoint)
		VALUES(
			$idorder,
			$pointnew)";
	
	mysql_query($sql) or die(mysql_error());
	}
}

/*Добавляем номера накладной*/
function addNakl($idorder, $nakl)
{    		
	if ($idorder <>0 and $nakl<>0)
	{
		$sql = "UPDATE orders
			SET number = '$nakl'
			WHERE id=$idorder";
	mysql_query($sql) or die(mysql_error());
	}
}

/*Реактирование или создание данных маршрута*/
function editRoute($id)
{
	if ($id > 0)
	{	
	$ss = 'AND route.id = '.$id;							
	$routes = getRoute($ss);	
	foreach($routes as $route){?>	
					
	<hr><table border="0" cellpadding="0" cellspacing="0" width="100%">		
	<form action="save_route.php?id=<?=$id?>" method="POST">
		<tr><td width=130>Тип ТС:</td>
			<td><select name='typets' size='1' style='width:170px;'>
				<option value='vse'>Выберите из списка</option>
				<?$typets = getTypeTS();  
				foreach($typets as $item){
					if ($item['id'] == $route['idtypets']) $select = ' selected ';
					else $select = '';
					echo "ss".$select;
					echo "<option ".$select." value='".$item['id']."'>".$item['type']."</option>";
				}?>
				</select></td></tr>	
				
		<tr><td>Пункт отправления:</td>		    
			<td><select name='point1' size='1' style='width:170px;'>
				<option value='vse'>Выберите из списка</option>
				<?$points = getPoint(); 
				foreach($points as $item){
					if ($item['id'] == $route['idpoint1']) $select = 'selected';
					else $select = '';
					echo "<option ".$select." value='".$item['id']."'>".$item['point']."</option>";
				}?>
				</select></td></tr>
		
		<tr><td>Пункт назначения:</td>
			<td><select name='point2' size='1' style='width:170px;'>
				<option value='vse'>Выберите из списка</option>
				<?$points = getPoint(); 
				foreach($points as $item){
					if ($item['id'] == $route['idpoint2']) $select = ' selected ';
					else $select = '';
					echo "<option ".$select." value='".$item['id']."'>".$item['point']."</option>";
				}?>
				</select></td></tr>
				
		<tr><td>Расстояние:</td><td><input type='text' name='dist' style='width:167px' value=<?=$route['dist']?>></td></tr>
		<tr><td>Время:</td><td><input type='text' name='time' style='width:167px' value=<?=$route['time']?>></td></tr>
	</table
		<?}
		if ($id > 0) $ss = 'Сохранить';
		else $ss = 'Добавить'
		?>
        <p><input type="submit" value=<?=$ss?> name="submit"></p>
	</form>				
<?	}
}

function saveNews($id, $date, $title, $news)
{
	if ($id > 0)
	{
		$sql = "UPDATE news
			SET date = '$date',
			title = '$title',
			news = '$news'
			WHERE id=$id";
	}
	else
	{
		$sql = "INSERT INTO news( 
			date,
			title,
			news)
		VALUES(
			'$date',
			'$title',
			'$news')";		
	}
	
	mysql_query($sql) or die(mysql_error());
}

function saveTypets($id, $type, $price)
{
	if ($id > 0)
	{
		$sql = "UPDATE typets
			SET type = '$type',
			price = $price
			WHERE id=$id";
	}
	else
	{
		$sql = "INSERT INTO typets( 
			type,
			price)
		VALUES(
			'$type',
			$price)";		
	}
	
	mysql_query($sql) or die(mysql_error());
}

function savePoint($id, $point, $idregion)
{
	if ($id > 0)
	{
		$sql = "UPDATE points
			SET point = '$point',
			idregion = $idregion
			WHERE id=$id";
	}
	else
	{
		$sql = "INSERT INTO points( 
			point,
			idregion)
		VALUES(
			'$point',
			$idregion)";		
	}
	
	mysql_query($sql) or die(mysql_error());
}

function saveRegion($id, $region)
{
	if ($id > 0)
	{
		$sql = "UPDATE region
			SET region = '$region'
			WHERE id=$id";
	}
	else
	{
		$sql = "INSERT INTO region( 
			region)
		VALUES(
			'$region')";		
	}
	
	mysql_query($sql) or die(mysql_error());
}

function saveRoute($id, $idtypets, $idpoint1, $idpoint2, $dist, $time)
{
	if ($id > 0)
	{
		$sql = "UPDATE route
			SET idtypets = '$idtypets',
			idpoint1 = '$idpoint1',
			idpoint2 = '$idpoint2',
			dist = '$dist',
			time = '$time'
			WHERE id=$id";
	}
	else
	{
		$sql = "INSERT INTO route( 
			idtypets,
			idpoint1,
			idpoint2,
			dist,
			time)
		VALUES(
			$idtypets,
			$idpoint1,
			$idpoint2,
			$dist,
			$time)";		
	}

	mysql_query($sql) or die(mysql_error());
}

/*---Добавляем товары в корзину---*/
function add2basket($customer, $goodsid, $datetime)
{    
	$quantity = 1;
	$sql = "SELECT id, quantity  
			FROM basket
            WHERE customer='$customer' AND catalogid=$goodsid";
	
	$resultat = mysql_query($sql) or die(mysql_error());	
	$goods = dataBaseToArray($resultat);
		
	if(mysql_num_rows($resultat) > 0)
	{
		foreach($goods as $item){		
			$quantity = $item["quantity"] + 1;
			
			$sql = "UPDATE basket
				SET            
				quantity=$quantity,            
				datetime='$datetime'
			WHERE
				customer='$customer' AND
				catalogid=$goodsid";
			}
	}
	else 
	{		
		$sql = "INSERT INTO basket( 
			customer,
            catalogid,			
            quantity,
            datetime)
        VALUES(
            '$customer',
            $goodsid,			
            $quantity,
            '$datetime'
        )";
	}	

    mysql_query($sql) or die(mysql_error());
}

/*---Возвращаем всю пользовательскую корзину---*/
function myBasket(){
    $sql = "SELECT
                catalogid,
				article,
                name,
                price,
                discount,
                basket.id,                
                customer,
                quantity
            FROM catalog, basket
            WHERE customer='".session_id()."'
            AND catalog.id=basket.catalogid";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function ShowContentProducts()
{                
	$goods = selecttypeAll();				
	foreach($goods as $item){				 	
		echo "<center><a href='catalog.php?id=".$item['id']."' target='_parent'><img width='100' src='type/".$item['id'].".jpg' alt='product' /><br>".$item['type']."</a><br></center>";				
	}						
}

function selecttypeAll()
{
    $sql = "SELECT * FROM type";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function selectAlltype($typeid)
{
    $sql = "SELECT * FROM catalog WHERE typeid=$typeid";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}

function ShowProducts($typeid)
{
	echo "<h2>Товары магазина</h2>  
	<table border='0' cellpadding='0' cellspacing='0' width='100%'>";								               	                  
	$goods = selectAlltype($typeid);					
	foreach($goods as $item){				
		echo "<tr><td>
		<a href='' target='_parent'><img width='130' src='catalog/".$item['id'].".jpg' alt='product' /></a>";		 
		echo "</td><td valign='top'><a href='' target='_parent'><h3>".$item['name']."</h3></a>		
		Артикул: ".$item['article']."<br>".$item['note']."<br>
		<h4>Количество: ".$item['amount']." у.е.     Цена: ".$item['price']." р.";
		if ($item['discount'] <> 0){
			echo "     Скидка : ".$item['discount']." %</h4>";
		}
		echo "<a href='add2basket.php?id=".$item['id']."'>В корзину</a></td></tr>";										
		$ii++;
	}
	echo "</table>"; 
}

/*---Удаление данных из корзины---*/
function basketDel($id){
    $sql = "DELETE FROM basket WHERE id=$id";
    mysql_query($sql) or die(mysql_error());
}

function getCityId($name)
{
    $sql = "SELECT id FROM points WHERE point = '$name' OR point = '$name'";
    $resultat = mysql_query($sql) or die(mysql_error());
    return dataBaseToArray($resultat);
}
?>
