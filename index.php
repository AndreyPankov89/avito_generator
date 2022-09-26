<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Document</title>
</head>
<body>
    <?php
        include_once('./utils/get_filenames.php');
    ?>
    <pre>
    <div class="container" id="dump">

    </div>
    </pre>
    <div class="container">
        <div class="row">
            <div class='col-2'>
                <span>Номер шаблона</span>
                <select lisabled name="template" id="template">
                    <option value="templ1">Шаблон 1</option>
                    <option value="templ2">Шаблон 2</option>
                </select>
            </div>
            <div class="col-2">
                <span>Имя Менеджера</span>
                 <input type="text" name="managerName" id="managerName">
            
            </div>
            <div class="col-2">
                <span>Дней размещения</span>
                <select name="days_count" id="days_count">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                </select>                
            </div>
  </div>
        
    </div>
    <div class="container1">
        <table id="table">
            <tr>
                <td><input type="checkbox" id="checkall"></td>
                <td>id</td>
                <td>Заголовок</td>
                <td>Текст</td>
                <td>Картинки</td>
                <td>Цена</td>
                <td>Время</td>
                <td>Место</td>
                <td>Категория</td>      
                <td>Способ связи</td>
                <td>Телефон</td>      
                <td>Услуги</td>    
                <td>Тип ЖБ</td>
                <td></td>         
                <td></td>
            </tr>
            
        </table>
        <button class='btn btn-primary' id='save'>Сохранить таблицу</button>
    </div>
    <div class="container" id="root">

    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-3 offset-2">
                <button class=" btn btn-primary" id='submit' >Создать файл</button>
            </div>
            <div class="col-3 offset-2">
                <button class="btn btn-primary" id='add_item'>Добавить строку</button>
            </div>
            
                
        </div>
    </div>
    <template id="item_template">
        <div class="row item">
            <div class="col-2 align-self-center">
                <span>Название</span> 
                <input type="text" name="title" id="title">
            </div>
            <div class="col-2 align-self-center">
                <span>Имя файла с текстами</span> 
                <select name="descriptions" id="descriptions" rows="1">
                    <? 
                    $filenames = get_filenames('assets/texts');
                    foreach ($filenames as &$f){
                    ?>
                    <option value="<?echo '/assets/texts/'.$f;?>"><?echo $f;?></option>
                    <? 
                    }
                    ?>    
                </select>
            </div>
            <div class="col-2 align-self-center">
                <span>Имя папки с картинками</span> 
                <select name="image_folder" id="image_folder" rows="1">
                    <? 
                    $filenames = get_filenames('assets/images');
                    foreach ($filenames as &$f){
                    ?>
                    <option value="<?echo '/assets/images/'.$f;?>"><?echo $f;?></option>
                    <? 
                    }
                    ?>   
                </select>
            </div>
            <div class="col-2 align-self-center">
                <span>Цена</span> 
                <input type="text" name="price" id="price">
            </div>        
            <div class="col-2 align-self-center">
                <span>Время выкладки</span> <br>
                <select name="time" id="time">
                    <option value="11:00:00+03:00">11:00</option>
                    <option value="16:00:00+03:00">16:00</option>
                    <option value="19:00:00+03:00">19:00</option>
                </select>
            </div>                  
            <div class="col-2 align-self-center">
                <span>Место</span> 
                <select type="text" name="place" id="place">
                    <option value="Нижний Новгород">Нижний Новгород</option>
                </select>
            </div>
            <div class="col-2 align-self-center">
                <span>Категория</span> 
                <select name="goods_subtype" id="goods_subtype" rows="1">
                    <option value="Строительство стен">Строительство стен</option>
                    <option value="Изоляция">Изоляция</option>
                    <option value="Крепеж">Крепеж</option>
                    <option value="Кровля и водосток">Кровля и водосток</option>
                    <option value="Лаки и краски">Лаки и краски</option>
                    <option value="Отделка">Отделка</option>
                    <option value="Металлопрокат">Металлопрокат</option>
                    <option value="Пиломатериалы">Пиломатериалы</option>
                    <option value="Строительные смеси">Строительные смеси</option>
                    <option value="Электрика">Электрика</option>
                    <option value="Лестницы и комплектующие">Лестницы и комплектующие</option>
                    <option value="Листовые материалы">Листовые материалы</option>
                    <option value="Ворота, заборы и ограждения">Ворота, заборы и ограждения</option>
                    <option value="Сыпучие материалы">Сыпучие материалы</option>
                    <option value="Железобетонные изделия">Железобетонные изделия</option>
                    <option value="Сваи">Сваи</option>
                    <option value="Другое">Другое</option></select>
            </div>      
            <div class="col-2 align-self-center">
                <span>Способ связи</span>
                <select name="contact_mode" id="contact_mode">
                    <option value="По телефону и в сообщениях">Звонки и сообщения</option>
                    <option value="По телефону">Звонки</option>
                    <option value="В сообщениях">Сообщения</option>
                </select>
            </div>
            <div class="col-2 align-self-center">
                <span>Номер телефона</span>
                <input type="text" id="phone" name="phone" value="+7 964 831-55-11">
            </div>   
            <div class="col-2 align-self-center">
                <span>Услуги</span>
                <select name="adStatus" id="AdStatus">
                    <option value="Free">Без услуг</option>
                    <option value="Highlight">Выделение</option>
                    <option value="XL">XL-объявление</option>
                    <option value="x2_1">х2 на день</option>
                    <option value="x2_7">х2 на 7 дней</option>
                    <option value="x5_1">х5 на день</option>
                    <option value="x5_7">х5 на 7 дней</option>
                    <option value="x10_1">х10 на день</option>
                    <option value="x10_7">х10 на 7 дней</option>
                    
                </select>
            </div>
            <div class="col-2 align-self-center">
                <span>Тип ЖБИ</span>
                <select name="gbt" id="gbt">
                    <option value="">Не ЖБИ</option>
                    <option value="Плита">Плита</option>
                    <option value="Лоток">Лоток</option>        
                    <option value="Другое">Бордюр</option>                    
                </select></div>
            <div class="col-2 align-self-center"></div>
        </div>
    </template>
    
    <template id="table_row">
        <tr>

        </tr>
    </template>
    <script src="./index.js"></script>

</body>
</html>