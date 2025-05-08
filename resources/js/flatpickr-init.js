document.addEventListener("alpine:init", () => {
    Alpine.data("flatpickrComponent", (options) => ({
        picker: null,
        init() {
            const defaultOptions = {
                locale: 'en',
                altInput: true,
                dateFormat: 'Y-m-d',
                altFormat: 'F j, Y',
            };

            // Mezclar opciones por defecto con las del campo
            const config = {
                ...defaultOptions,
                ...options,
                onChange: this.wrapCallback(options.onChange),
                onOpen: this.wrapCallback(options.onOpen),
                onClose: this.wrapCallback(options.onClose),
                onReady: this.wrapCallback(options.onReady),
                onValueUpdate: this.wrapCallback(options.onValueUpdate),
            };

            // Inicializar Flatpickr
            this.picker = flatpickr(this.$refs.input, config);
        },
        wrapCallback(callback) {
            if (typeof callback === "string") {
                try {
                    // Convertir el callback string en una función
                    return new Function("selectedDates", "dateStr", "instance", callback);
                } catch (e) {
                    console.error("Error al procesar el callback:", e);
                }
            }
            return callback;
        },
        refresh() {
            if (this.picker) {
                this.picker.destroy();
                this.init();
            }
        }
    }));
});
