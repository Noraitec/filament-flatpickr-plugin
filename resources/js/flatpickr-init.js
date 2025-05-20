// resources/js/flatpickr-init.js

document.addEventListener('alpine:init', () => {
  Alpine.data('flatpickrComponent', options => ({
    picker: null,

    init() {
      // 1️⃣ Defaults
      const defaultOptions = {
        altInput: true,
        dateFormat: 'Y-m-d',
        altFormat: 'F j, Y',
      };

      // 2️⃣ Build plugin instances
      const pluginInstances = [];

      // 2a) Always honor `options.weekSelect` (even if options.plugins is missing)
      if (options.weekSelect && typeof window.weekSelect === 'function') {
        pluginInstances.push(
          window.weekSelect(options.weekSelect)
        );
      }

      // 2b) Then any other plugins listed in options.plugins
      if (Array.isArray(options.plugins)) {
        options.plugins.forEach(name => {
          if (name === 'weekSelect') return; // we already did it
          const factory = window[name] || window[`${name}Plugin`];
          if (typeof factory === 'function') {
            pluginInstances.push(
              factory(options[name] || {})
            );
          }
        });
      }

      // 3️⃣ Merge everything
      const config = {
        ...defaultOptions,
        ...options,
        plugins: pluginInstances,
      };

      // 4️⃣ If weekSelect is active, override onChange to write a full‐week range
      if (options.weekSelect && window.weekSelect) {
        const originalOnChange = config.onChange;
        config.onChange = function(selectedDates, dateStr, instance) {
          if (instance.weekStartDay && instance.weekEndDay) {
            const fmt = instance.config.altFormat || instance.config.dateFormat;
            instance._input.value = [
              instance.formatDate(instance.weekStartDay, fmt),
              instance.formatDate(instance.weekEndDay,   fmt),
            ].join(' – ');
          }
          if (typeof originalOnChange === 'function') {
            originalOnChange.call(this, selectedDates, dateStr, instance);
          }
        };
      }

      // 5️⃣ Initialize Flatpickr
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
