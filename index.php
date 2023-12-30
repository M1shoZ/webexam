<?php
    include "db.php";
    $result = mysqli_query($link, "SELECT * FROM `0` limit 10");
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">    
    <title>Административная панель</title>
</head>
<body>

<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Административная панель</a>
    </div>
</nav>

<!-- Область для всплывающих уведомлений -->
<div class="container mt-3">
    <div class="alert alert-success" role="alert">
        Ваши уведомления здесь
    </div>
</div>

<!-- Форма для поиска записей -->
<div class="container mt-3 border p-3">
    <form id="searchForm">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Наименование:</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="district" class="form-label">Административный округ:</label>
                    <select class="form-select" id="district" name="district">
                        <option value="">Не выбрано</option>
                        <!-- Динамические опции будут добавлены с помощью JavaScript -->
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="type" class="form-label">Вид объекта:</label>
                    <select class="form-select" id="type" name="type">
                        <option value="">Не выбрано</option>
                        <!-- Динамические опции будут добавлены с помощью JavaScript -->
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="network" class="form-label">Является сетевым:</label>
                    <select class="form-select" id="network" name="network">
                        <option value="">Не выбрано</option>
                        <option value="yes">Да</option>
                        <option value="no">Нет</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="benefits" class="form-label">Льготы:</label>
                    <select class="form-select" id="benefits" name="benefits">
                        <option value="">Не выбрано</option>
                        <option value="yes">Да</option>
                        <option value="no">Нет</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="seats" class="form-label">Количество посадочных мест:</label>
                    <div class="row">
                        <div class="col">
                            <input type="number" class="form-control" id="seatsFrom" name="seatsFrom" placeholder="От">
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" id="seatsTo" name="seatsTo" placeholder="До">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="startDate" class="form-label">Дата создания (с):</label>
                    <input type="date" class="form-control" id="startDate" name="startDate">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="endDate" class="form-label">Дата создания (по):</label>
                    <input type="date" class="form-control" id="endDate" name="endDate">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="searchRecords()">Найти</button>
    </form>
</div>


<!-- Таблица с данными о предприятиях -->
<div class="container mt-3 border p-3">
    <!-- Форма для поиска записей -->

    <div class="table-responsive">
        <table class="table" id="recordsTable">
            <<thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col">Вид объекта</th>
                    <th scope="col">Адрес</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    // Вывод данных
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Name"]. "</td>";
                        echo "<td>" . $row["TypeObject"]. "</td>";
                        echo "<td>" . $row["Address"]. "</td>";
                        echo "</tr>";
                    }
                ?>
                <!-- Чекбокс для выбора записи -->
                <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="selectCheckbox">
                        </div>

                        <!-- Текстовый символ для редактирования -->
                        <button type="button" class="btn btn-warning btn-sm mx-1 btn-light" id="editButton" data-bs-toggle="modal" data-bs-target="#createEditModal">
                            ✎
                        </button>
                        
                        <!-- Текстовый символ для удаления -->
                        <button type="button" class="btn btn-danger btn-sm mx-1 btn-light"  data-bs-toggle="modal" data-bs-target="#deleteModal">
                            🗑
                        </button>
                    </td>
            </tbody>
        </table>
    </div>
</div>

<!-- Пагинация -->
<div class="container mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
        </ul>
    </nav>
</div>


<!-- Нижняя часть сайта (footer) -->
<footer class="footer mt-5 bg-dark text-light text-center">
    <div class="container">
        <p>Информация о компании | Контакты</p>
    </div>
</footer>

<!-- Модальное окно для удаления записи -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Подтверждение удаления</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить данные предприятия <span id="deleteEntityName"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                <button type="button" class="btn btn-danger" onclick="deleteEntity()">Да</button>
            </div>
        </div>
    </div>
</div>


<!-- Модальное окно для создания/редактирования записи -->
<div class="modal fade" id="createEditModal" tabindex="-1" aria-labelledby="createEditModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEditModalLabel">Редактирование записи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createEditForm">
                    <!-- Наименование -->
                    <div class="mb-3">
                        <label for="entityName" class="form-label">Наименование:</label>
                        <input type="text" class="form-control" id="entityName" name="entityName">
                    </div>
                    
                    
                    <!-- Является сетевым (да/нет) -->
                <div class="mb-3">
                    <label for="isNetwork" class="form-label">Является сетевым:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isNetwork" id="isNetworkYes" value="yes">
                        <label class="form-check-label" for="isNetworkYes">
                            Да
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="isNetwork" id="isNetworkNo" value="no">
                        <label class="form-check-label" for="isNetworkNo">
                            Нет
                        </label>
                    </div>
                </div>
                    <!-- Название управляющей компании -->
                    <div class="mb-3">
                        <label for="managementCompany" class="form-label">Название управляющей компании:</label>
                        <input type="text" class="form-control" id="managementCompany" name="managementCompany">
                    </div>

                    <!-- Вид объекта -->
                    <div class="mb-3">
                        <label for="objectType" class="form-label">Вид объекта:</label>
                        <input type="text" class="form-control" id="objectType" name="objectType">
                    </div>

                    <!-- Административный округ -->
                    <div class="mb-3">
                        <label for="adminDistrict" class="form-label">Административный округ:</label>
                        <input type="text" class="form-control" id="adminDistrict" name="adminDistrict">
                    </div>

                    <!-- Район -->
                    <div class="mb-3">
                        <label for="district" class="form-label">Район:</label>
                        <input type="text" class="form-control" id="district" name="district">
                    </div>

                    <!-- Адрес -->
                    <div class="mb-3">
                        <label for="address" class="form-label">Адрес:</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>

                    <!-- Число посадочных мест -->
                    <div class="mb-3">
                        <label for="seats" class="form-label">Число посадочных мест:</label>
                        <input type="number" class="form-control" id="seats" name="seats">
                    </div>

                    <!-- Показатель социальных льгот -->
                    <div class="mb-3">
                        <label for="socialBenefits" class="form-label">Показатель социальных льгот:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="socialBenefits" id="socialBenefitsYes" value="yes">
                        <label class="form-check-label" for="socialBenefitsYes">
                             Да
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="socialBenefits" id="socialBenefitsNo" value="no">
                        <label class="form-check-label" for="socialBenefitsNo">
                            Нет
                         </label>
                    </div>
                    <!-- Телефон -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон:</label>
                        <input type="tel" class="form-control" id="phone" name="phone">
                    </div>

                    <!-- Географические координаты -->
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Широта:</label>
                        <input type="text" class="form-control" id="latitude" name="latitude">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Долгота:</label>
                        <input type="text" class="form-control" id="longitude" name="longitude">
                    </div>

                    <!-- Кнопки -->
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" onclick="saveRecord()">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
