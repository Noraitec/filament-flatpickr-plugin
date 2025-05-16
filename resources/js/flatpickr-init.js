document.addEventListener("alpine:init", () => {
    Alpine.data("flatpickrComponent", (options) => ({
        init() {
            // Configuración predeterminada
            const defaultOptions = {
                locale: 'en',
                altInput: true,
                dateFormat: 'Y-m-d',
                altFormat: 'F j, Y',
            };

            // Mezclamos las opciones predeterminadas con las opciones del campo
            const config = {
                ...defaultOptions,
                ...options,
                onChange: this.wrapCallback(options.onChange),
                onOpen: this.wrapCallback(options.onOpen),
                onClose: this.wrapCallback(options.onClose),
                onReady: this.wrapCallback(options.onReady),
                onValueUpdate: this.wrapCallback(options.onValueUpdate),
            };

            try {
                // Inicializamos Flatpickr
                this.picker = flatpickr(this.$refs.input, config);
            } catch (error) {
                console.error("Error inicializando Flatpickr:", error);
            }
        },

        wrapCallback(callback) {
            if (typeof callback === "string") {
                try {
                    // Verificamos si el callback es una función válida
                    const functionBody = callback.trim();
                    if (functionBody.startsWith("(") && functionBody.endsWith("}")) {
                        // Si es una función completa, la convertimos directamente
                        return new Function("selectedDates", "dateStr", "instance", functionBody);
                    } else {
                        // Si es solo el contenido de una función, envolvemos en una expresión lambda
                        return new Function("selectedDates", "dateStr", "instance", `(${functionBody})`);
                    }
                } catch (e) {
                    console.error("Error al procesar el callback:", e);
                }
            } else if (typeof callback === "function") {
                return callback;
            }
            return undefined;
        },

        refresh() {
            try {
                if (this.picker) {
                    this.picker.destroy();
                }
                this.init();
            } catch (error) {
                console.error("Error al refrescar Flatpickr:", error);
            }
        }
    }));
});
