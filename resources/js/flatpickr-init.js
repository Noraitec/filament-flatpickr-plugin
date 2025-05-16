import flatpickr from 'flatpickr';
import weekSelectPlugin from '../flatpickr/plugins/weekSelect/weekSelect'; // ruta relativa ajustada

document.addEventListener('alpine:init', () => {
  Alpine.data('flatpickrComponent', options => ({
    init() {
      // Configuración predeterminada
      const defaultOptions = {
        altInput: true,
        dateFormat: 'Y-m-d',
        altFormat: 'F j, Y',
      };

      // Inyectamos el plugin weekSelect
      const plugins = [new weekSelectPlugin()];

      // Mezclamos las opciones: primero defaults, luego plugins, luego opciones del usuario
      const config = {
        ...defaultOptions,
        plugins,
        ...options,
        onChange: this.wrapCallback(options.onChange),
        onOpen: this.wrapCallback(options.onOpen),
        onClose: this.wrapCallback(options.onClose),
        onReady: this.wrapCallback(options.onReady),
        onValueUpdate: this.wrapCallback(options.onValueUpdate),
      };

      try {
        this.picker = flatpickr(this.$refs.input, config);
      } catch (error) {
        console.error('Error inicializando Flatpickr:', error);
      }
    },

    wrapCallback(callback) {
      if (typeof callback === 'string') {
        try {
          return new Function('selectedDates', 'dateStr', 'instance', callback);
        } catch (e) {
          console.error('Error al procesar el callback:', e);
        }
      } else if (typeof callback === 'function') {
        return callback;
      }
      return undefined;
    },

    refresh() {
      try {
        if (this.picker) this.picker.destroy();
        this.init();
      } catch (error) {
        console.error('Error al refrescar Flatpickr:', error);
      }
    },
  }));
});