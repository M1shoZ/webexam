// JavaScript код для открытия модального окна и установки имени перед удалением
function openDeleteModal(entityName) {
    // Установить имя предприятия в модальном окне
    document.getElementById('deleteEntityName').innerText = entityName;

    // Открыть модальное окно
    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    deleteModal.show();
}

// Пример вызова функции при нажатии на кнопку удаления
document.getElementById('deleteButton').addEventListener('click', function() {
    // Замените 'Название заведения 1' на фактическое имя вашей записи
    openDeleteModal('Название заведения 1');
});

// JavaScript код для открытия модального окна создания/редактирования
function openCreateEditModal(entityName) {
    // Установить значения полей формы в соответствии с данными записи
    document.getElementById('entityName').value = entityName;
    
    // Открыть модальное окно
    var createEditModal = new bootstrap.Modal(document.getElementById('createEditModal'));
    createEditModal.show();
}

// Пример вызова функции при нажатии на кнопку редактирования
document.getElementById('editButton').addEventListener('click', function() {
    // Замените 'Название заведения 1' на фактическое имя вашей записи
    openCreateEditModal('Название заведения 1');
});

