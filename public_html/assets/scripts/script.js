import { ModalWindow } from "/assets/scripts/components/modal/modal.js";
import { InputListManager } from "./forms/input-list-manager.js";
document.addEventListener('DOMContentLoaded', function () {
    initModalBindings();
    var inputListManager = new InputListManager();
    document.querySelectorAll('.slider').forEach(element => new Slider(element));
});

function initModalBindings() {
    var modals = document.querySelectorAll('[data-modal-name]');
    modals.forEach(function (item) {
        var name = item.getAttribute('data-modal-name');
        if (!name) {
            console.warn("\u041C\u043E\u0434\u0430\u043B\u044C\u043D\u043E\u0435 \u043E\u043A\u043D\u043E \u0431\u0435\u0437 data-modal-name", item);
            return;
        }
        var modal = new ModalWindow(name);
    });
    console.log('Модальные окна инициализированы:', modals.length);
}

class Slider
{
    slider = null;
    slidesContainer = null;
    indicatorsContainer = null;

    constructor(element)
    {
        this.slider = element;
        this.slidesContainer = element.querySelector('.slider__data');

        this.indicatorsContainer = document.createElement('div');
        this.indicatorsContainer?.classList.add('slider__indicators');
        this.slider?.appendChild(this.indicatorsContainer);

        let count = this.slidesContainer?.querySelectorAll('.slider__item').length;

        for (let i = 0; i < count; ++i)
        {
            let indicator = document.createElement('div');
            indicator.classList.add('slider__indicator');
            if (i === 0)
            {
                indicator.classList.add('active');
            }

            indicator.addEventListener('click', () => {
                this.slidesContainer.style.transform = 'translateX(-' + i * 100 + '%)';
                this.slider?.querySelectorAll('.slider__indicator').forEach(item => item.classList.remove('active'))
                indicator.classList.add('active');
            });

            this.indicatorsContainer?.appendChild(indicator);
        }
    }
}