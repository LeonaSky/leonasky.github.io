<?php
   require ('http://leonasky.github.io/laba 4/phpQuery.php');
   
  $habrablog = file_get_contents('http://%username%.habrahabr.ru/blog/');
  
  $document = phpQuery::newDocument($habrablog);
  
  $hentry = $document->find('div.hentry');
  
  foreach ($hentry as $el) {
    $pq = pq($el); // Это аналог $ в jQuery
    $pq->find('h2.entry-title > a.blog')->attr('href', 'http://%username%.habrahabr.ru/blog/')->html('%username%'); // меняем атрибуты найденого элемента
    $pq->find('div.entry-info')->remove(); // удаляем ненужный элемент
    $tags = $pq->find('ul.tags > li > a');
    $tags->append(': ')->prepend(' :'); // добавляем двоеточия по бокам
    $pq->find('div.content')->prepend('<br />')->prepend($tags); // добавляем контент в начало найденого элемента
  }
  
  echo $hentry;
?>
