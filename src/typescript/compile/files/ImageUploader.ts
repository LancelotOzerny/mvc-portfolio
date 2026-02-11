class ImageUploader
{
    private input: HTMLInputElement;
    private previewArea: HTMLElement;
    private removeButton: HTMLButtonElement;
    private placeholder: HTMLElement;

    constructor()
    {
        this.input = document.getElementById('image-input') as HTMLInputElement;
        this.previewArea = document.getElementById('preview-area') as HTMLElement;
        this.removeButton = document.getElementById('remove-button') as HTMLButtonElement;
        this.placeholder = this.previewArea.querySelector('.placeholder') as HTMLElement;

        this.init();
    }

    private init(): void
    {
        // Клик по зоне → открытие диалога выбора файла
        this.previewArea.addEventListener('click', () =>
        {
            if (!this.previewArea.querySelector('img'))
            {
                this.input.click();
            }
        });

        // Выбор файла через input
        this.input.addEventListener('change', (e) =>
        {
            const file = (e.target as HTMLInputElement).files?.[0];
            if (file)
            {
                this.handleFile(file);
            }
        });

        // Перетаскивание: визуальная обратная связь
        ['dragover', 'dragenter'].forEach((evt) =>
        {
            this.previewArea.addEventListener(evt, (e) =>
            {
                e.preventDefault();
                this.previewArea.style.borderColor = '#00bcd4';
            });
        });

        ['dragleave', 'dragend', 'drop'].forEach((evt) =>
        {
            this.previewArea.addEventListener(evt, () =>
            {
                this.previewArea.style.borderColor = '#ccc';
            });
        });

        // Обработка сброса файла при перетаскивании
        this.previewArea.addEventListener('drop', (e) =>
        {
            e.preventDefault();
            const file = e.dataTransfer?.files?.[0];
            if (file)
            {
                this.handleFile(file);
            }
        });

        // Удаление изображения
        this.removeButton.addEventListener('click', () =>
        {
            this.resetPreview();
        });
    }

    private handleFile(file: File): void
    {
        if (!file.type.startsWith('image/'))
        {
            alert('Пожалуйста, выберите изображение (jpg, png, gif и т. д.)');
            return;
        }

        const img = document.createElement('img');
        img.onload = () =>
        {
            URL.revokeObjectURL(img.src);
        };
        img.src = URL.createObjectURL(file);

        this.previewArea.innerHTML = '';
        this.previewArea.appendChild(img);
        this.previewArea.appendChild(this.removeButton);

        this.removeButton.style.display = 'block';
    }

    private resetPreview(): void
    {
        this.previewArea.innerHTML = '';
        this.previewArea.appendChild(this.placeholder);
        this.previewArea.appendChild(this.removeButton);

        this.removeButton.style.display = 'none';

        this.input.value = '';
    }
}
