## Вариант №1 (еще 30 дней)
1) разворачиваем в ненужном месте (например на своем компьютере в веб-окружении) новую версию того же номинала(Бизнес, Эксперт и т.п.)
2) создаем страничку в блокноте, и туда копируем:
3) ключ: /bitrix/modules/main/admin/define.php
4) значение параметра по запросу: select * from b_option where module_id="main" and name="admin_passwordh"
5) ключ отсюда: \bitrix\license_key.php
6) идем на сайт, который надо продлить, дальнейшие действия производим там
7) вставляем ключи в соответствующие файлы. Если есть сомнения, копируем старые значения на другую страницу блокнота перед вставкой новых
8) вставляем значение в базу (не забыв поменять демонстрационный код):
   UPDATE b_option SET VALUE = "FVkQfWYUBgYtCUVcAhcECgsTAQ=="
   WHERE module_id="main" and name="admin_passwordh"
   9)удаляем весь управляемый кэш
   <h3>Вариант №2 (еще сколько хочешь)</h3>
   Взят <a href="https://dmitriydef.ru/tags/hak/">отсюда</a>.
   Создаем файл prolong.php с содержанием:
```php
function BitrixExpireDate($date, $key){
    $outCode = '';
    $x = 0;
    for ($i = 0; $i < strlen($date); $i++) {
        $outCode .= chr(ord($date[$i]) ^ ord($key[$x]));
        if ($x == strlen($key) - 1)
            $x = 0;
        else
            $x = $x + 1;
        }
    return $outCode;
}

$key1 = 'DO_NOT_STEAL_OUR_BUS'; // OLDSITEEXPIREDATE
$key2 = 'thRH4u67fhw87V7Hyr12Hwy0rFr'; // SITEEXPIREDATE

$nowDate = date('mdY', time() + 60*60*24*365*5); // сегодня + 5 лет

$codeDate1 = 'XX'.$nowDate[3].$nowDate[7].'XX'.$nowDate[0].$nowDate[5].'X'.$nowDate[2].'XX'.$nowDate[4].'X'.$nowDate[6].'X'.$nowDate[1].'X'; // OLDSITEEXPIREDATE
$codeDate2 = 'X'.$nowDate[2].'X'.$nowDate[1].'XX'.$nowDate[0].$nowDate[6].'XX'.$nowDate[4].'X'.$nowDate[7].'X'.$nowDate[3].'XXX'.$nowDate[5]; // SITEEXPIREDATE

$outCode1 = base64_encode(BitrixExpireDate($codeDate1, $key1)); // OLDSITEEXPIREDATE
$outCode2 = base64_encode(BitrixExpireDate($codeDate2, $key2)); // SITEEXPIREDATE

echo "For prolongation bitrix make following:\n";
echo "1. Replace constant 'TEMPORARY_CACHE' in file /bitrix/modules/main/admin/define.php with value:\n    $outCode1\n";
echo "2. Update value of variable 'admin_passwordh' in table b_option:\n    update b_option set value='$outCode2' where name='admin_passwordh';\n";
```

Запускаем:
<pre class="lang:bash">$ php -f prolong.php
</pre>
На выходе получаем:
<pre class="lang:bash">HBdofBcMb2MMdBkUbRdnCm4a
LFkKeWwtBgU+MEVgBQ4AECEqAQ==
</pre>
Первое значение <code>HBdofBcMb2MMdBkUbRdnCm4a</code> вставляем вместо старого в /bitrix/modules/main/admin/define.php
<pre class="lang:php"><!--?php
// old
// define("TEMPORARY_CACHE", "ARtoeQYHb2MMdQgebRtkG24A");?-->

// new
define("TEMPORARY_CACHE", "HBdofBcMb2MMdBkUbRdnCm4a");
</pre>
А вторым значением <code>LFkKeWwtBgU+MEVgBQ4AECEqAQ==</code> обновляем опцию <code>admin_passwordh</code> в таблице b_option:
<pre class="lang:mysql">update b_option set value='LFkKeWwtBgU+MEVgBQ4AECEqAQ==' where name='admin_passwordh';</pre>
И удаляем весь управляемый кэш (каталог /bitrix/managed_cache)
