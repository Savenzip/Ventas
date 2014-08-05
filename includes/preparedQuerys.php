<?php
/**
 * SQL prepared statements
 * Naming standard for defines:
 * {CLASS}_{SEL/INS/UPD/DEL/REP}_{Summary of data changed}
 * When updating more than one field, consider looking at the calling function
 * name for a suiting suffix.
 * Ej: define("WEBSITE_SEL_URL","SELECT * FROM url_shorter WHERE account_id = ?");
 */
define ( "CAJA_INS_PRODUCT", "INSERT INTO temp_caja (cadenalogin,id_vendedor,cod_prod, peso,voucher) VALUES (?,?,?,?,?)" );
define ( "CAJA_GET_PRODUCT", "SELECT t.id,t.cod_prod,t.peso,p.nombre_producto,l.precio FROM temp_caja t, producto p, lista_precios l WHERE p.id_producto = t.cod_prod and p.id_producto = l.id_stock and cadenalogin = ?" );
define ( "CAJA_DEL_PRODUCTS", "DELETE FROM temp_caja WHERE cadenalogin = ?" );
define ( "CAJA_DEL_ITEM", "DELETE FROM temp_caja WHERE id = ?" );
define ( "CAJA_SEL_DESCRIPCION", "SELECT nombre_producto FROM producto WHERE id_producto = ?" );

define ( "LOGIN_SEL_EMPLEADO", "SELECT rut_empleado FROM empleado WHERE user= ?" );
define ( "LOGIN_SEL_EMPLEADOPWD", "SELECT rut_empleado FROM empleado WHERE user= ? and password= ?" );
define ( "LOGIN_SEL_LOGIN", "SELECT cadenalogin FROM empleado_login WHERE cadenalogin = ?" );
define ( "LOGIN_INS_LOGIN", "INSERT INTO empleado_login (cadenalogin, rut_empleado, fechalogin, iniciosesion, activo) VALUES (?, ?, now(), now(), TRUE)" );
define ( "LOGIN_SEL_LOGINTIME", "SELECT cadenalogin FROM empleado_login WHERE cadenalogin = ? and iniciosesion > now()- interval 120 minute" );
define ( "LOGIN_UPD_LOGINKILL", "UPDATE empleado_login SET activo=FALSE, finsesion = (now()) WHERE cadenalogin = ?" );
define ( "LOGIN_UPD_LOGINTIME", "UPDATE empleado_login SET iniciosesion=now() WHERE cadenalogin = ?" );
define ( "LOGIN_SEL_LEVELACC", "SELECT id_rol FROM empleado WHERE rut_empleado = ?" );

define ( "REGISTRO_SEL_SUCURSAL", "SELECT id_sucursal, nombre_sucursal FROM sucursal order by id_sucursal" );
define ( "REGISTRO_SEL_ROLUSER", "SELECT nombre_rol,nivelacceso FROM rol_empleado order by nivelacceso" );
define ( "REGISTRO_INS_EMPLEADO", "INSERT INTO empleado (rut_empleado,id_sucursal,id_rol, nombre_empleado, apellido_empleado, user, password, fechaingreso )	VALUES (?, ?, ?, ?, ?, ?,?, (now()))" );

define ( "PORTAL_SEL_MODULOS", "SELECT nombremodulo,Texto FROM modulo WHERE nivel = ?" );

define ( "GRUPO_SEL_GRUPO", "SELECT nombre_carne FROM carne WHERE id_carne = ?" );
define ( "GRUPO_INS_GRUPO", "INSERT INTO carne (id_carne, nombre_carne) VALUES (?,?)" );
define ( "GRUPO_DEL_GRUPO", "DELETE FROM carne WHERE id_carne = ?" );
define ( "GRUPO_UPD_GRUPO", "UPDATE carne SET nombre_carne = ? WHERE id_carne = ?" );

define ( "SUBGRP_SEL_SUBGRP", "SELECT nombre_ccarne FROM corte_carne WHERE id_ccarne = ?" );
define ( "SUBGRP_INS_SUBGRP", "INSERT INTO corte_carne (id_ccarne, nombre_ccarne) VALUES (?,?)" );
define ( "SUBGRP_DEL_SUBGRP", "DELETE FROM corte_carne WHERE id_ccarne = ?" );
define ( "SUBGRP_UPD_SUBGRP", "UPDATE corte_carne SET nombre_ccarne = ? WHERE id_ccarne = ?" );

define ( "PRODUCTO_INS_PRODUCTO", "INSERT INTO producto (id_producto,nombre_producto_id_ccarne,id_carne,unidad_medida)values(?,?,?,?,?)" );
define ( "PRODUCTO_DEL_PRODCUTO", "DELETE from producto where id_producto=?" );
define ( "PRODUCTO_UPD_PRODUCTO", "UPDATE producto SET id_carne=?,id_ccarne=?,nombre_producto=?,unidad_medida=? where id_producto=?" );
define ( "PRODUCTO_SEL_PRODCUTO", "SELECT id_producto, nombre_producto,id_carne,id_ccarne,unidad_medida from productos" );
define ( "PRODUCTO_SEL_GRUPO", "SELECT id_carne, nombre_carne FROM carne ORDER BY nombre_carne" );
define ( "PRODUCTO_SEL_SUBGRUPO", "SELECT id_ccarne, nombre_ccarne FROM corte_carne ORDER BY nombre_ccarne" );

define ( "LISTAPRECIO_INS_LISTAPRECIOS", "INSERT INTO lista_precios (id_lprecio,precio,fechacambioprecio,precio_anterior,id_procucto)values(?,?,?,?,?)" );
define ( "LISTAPRECIO_DEL_LISTAPRECIO", "DELETE from lista_precios where id_lprecios=?" );
define ( "LISTAPRECIO_UPD_PRODUCTO", "UPDATE lista_precios set precio=?,fechacambioprecio=?,precio_anterior=? where id_lprecios" );
define ( "LISTAPRECIO_SEL_LISTAPRECIO", "SELECT precio,fechacambioprecio,precio_anterior where id_lprecios=?" );

?>