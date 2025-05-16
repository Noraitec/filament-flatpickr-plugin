// resources/js/flatpickr-init.js

// Se asume que flatpickr y weekSelect están disponibles en window

document.addEventListener('alpine:init', () => {
  Alpine.data('flatpickrComponent', options => ({
    picker: null,

    init() {
      // Opciones por defecto
      const defaultOptions = {
        altInput: true,
        dateFormat: 'Y-m-d',
        altFormat: 'F j, Y',
      };

      // Construye array de plugins, incluyendo weekSelect si existe
      const plugins = [
        window.weekSelect && window.weekSelect(),
      ].filter(Boolean);

      // Mezcla: defaults, plugins, luego options pasadas como argumento
      const config = Object.assign({}, defaultOptions, { plugins }, options);

      // Aquí ajustamos el onChange para formatear el rango de semana
      // Personalizamoos la salida: mostrar rango de semana en lugar de fecha única
      config.onChange = function(selectedDates, dateStr, instance) {
        if (instance.weekStartDay && instance.weekEndDay) {
          // Usa altFormat si está definido, si no fallback a dateFormat
          const fmt = instance.config.altFormat || instance.config.dateFormat;
          const startStr = instance.formatDate(instance.weekStartDay, fmt);
          const endStr   = instance.formatDate(instance.weekEndDay,   fmt);
          instance._input.value = `${startStr} – ${endStr}`;
        }
      };

      try {
        this.picker = flatpickr(this.$refs.input, config);
      } catch (e) {
        console.error('Error inicializando Flatpickr:', e);
      }
    },

    refresh() {
      if (this.picker) {
        this.picker.destroy();
      }
      this.init();
    },
  }));
});
