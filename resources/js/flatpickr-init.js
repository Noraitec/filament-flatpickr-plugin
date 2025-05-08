document.addEventListener("alpine:init", () => {
    Alpine.data("flatpickrComponent", (options) => ({
        init() {
            const defaultOptions = {
                locale: 'en',
                altInput: true,
                dateFormat: 'Y-m-d',
                altFormat: 'F j, Y',
            };

            const config = {
                ...defaultOptions,
                ...options,
                onChange: this.wrapCallback(options.onChange),
                onOpen: this.wrapCallback(options.onOpen),
                onClose: this.wrapCallback(options.onClose),
                onReady: this.wrapCallback(options.onReady),
                onValueUpdate: this.wrapCallback(options.onValueUpdate),
            };

            // Initialize Flatpickr
            this.picker = flatpickr(this.$refs.input, config);
        },
        wrapCallback(callback) {
            if (typeof callback === "string") {
                try {
                    return new Function("selectedDates", "dateStr", "instance", callback);
                } catch (e) {
                    console.error("Invalid callback function:", e);
                }
            }
            return callback;
        },
        refresh() {
            this.picker.destroy();
            this.init();
        }
    }));
});