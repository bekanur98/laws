const elements = [...document.querySelectorAll('.faq-question__top')].forEach(accordion)

function accordion(element) {
    // объект, в котором будем хранить всю необходимую информацию
    const instance = {};
    function init() {
        // найдем вопрос и ответ
        findElements(instance, element);
        // измерим высоту ответа
        measureHeight(instance);
        // добавим логику нажатия на кнопку
        subscribe(instance);
    } init();
}

function findElements(object, element) {
    const instance = object;
    // element - это "вопрос", по которому происходит нажатие
    instance.element = element;
    // target - это "ответ", который должен "раскрываться"
    instance.target = element.nextElementSibling;
}

function measureHeight(object) {
    const instance = object;
    // вычисляем высоту ответа
    instance.height = object.target.firstElementChild.clientHeight;
}

function subscribe(instance) {
    instance.element.addEventListener('click', (event) => {
        // отменяем "действие по умолчанию"
        event.preventDefault();
        console.log(instance);
        // меняем состояние аккордеона
        changeElementStatus(instance);
    });
    // если размер окна поменяется - измерим высоту ответа заново
    window.addEventListener('resize', () => measureHeight(instance));
}

function changeElementStatus(instance) {
    if (instance.isActive) {
        hideElement(instance);
    } else {
        showElement(instance);
    }
}

function hideElement(object) {
    const instance = object;
    const { target } = instance;
    // обнуляем высоту ответа
    target.style.height = null;
    // делаем статус неактивным
    target.style.borderTop = 'none'
    instance.isActive = false;
}
function showElement(object) {
    const instance = object;
    const { target, height } = instance;
    // задаем ответу сохраненную в measureHeight высоту
    target.style.height = `${height}px`;
    target.style.borderTop = '1px solid #e1e3e3'
    // делаем статус активным
    instance.isActive = true;
}