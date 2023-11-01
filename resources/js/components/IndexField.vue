<template>
  <label class="container nova-switcher" @click.stop>
    <input
        class="input"
        type="checkbox"
        v-model="value"
        @change="toggle"
    />
    <span class="switch"></span>
    <span class="label">{{ label }}</span>
  </label>
</template>

<script>
export default {
  props: ['resourceName', 'resourceId', 'field', 'withoutRequest'],

  data: () => ({
    value: true,
  }),

  emits: ['change'],

  mounted() {
    this.value = this.reverse ? !this.field.value : this.field.value ?? false
    this.$emit('change', this.reverse ? !this.value : this.value)
  },

  methods: {
    toggle() {
      if (this.confirm[!this.value] && !confirm(this.confirm[!this.value])) {
        this.$nextTick(() => {
          this.value = !this.value
        })
        return;
      }
      if (this.withoutRequest) return
      Nova.request().post('/nova-vendor/nova-switcher/toggle/' + this.resourceName, {
        value: this.reverse ? !this.value : this.value,
        fieldName: this.field.attribute,
        resourceId: this.id,
      }).then((res) => {
        if (!res.data.success) {
          setTimeout(() => {
            this.value = !this.value
          }, 250)
        }
      })
    },
  },

  computed: {
    id() {
      return this.resourceId ?? this.$parent.resource.id.value
    },

    label() {
      if (!this.field.true_label && !this.field.false_label) {
        return null
      }
      return this.value ? (this.field.true_label ?? null) : (this.field.false_label ?? null)
    },

    reverse() {
      return this.field.reverse ?? false
    },

    confirm() {
      return {
        'true': this.field.confirm_to_false ?? false,
        'false': this.field.confirm_to_true ?? false,
      }
    }
  }
}
</script>
<style>
.dark .nova-switcher .switch {
  --light-gray: rgb(var(--colors-gray-600));
  --gray: rgb(var(--colors-gray-700));
  --dark-gray: rgb(var(--colors-gray-500));
  --teal: rgb(var(--colors-green-500));
  --dark-teal: rgb(var(--colors-green-500));
}
.dark .nova-switcher .label {
  color:rgba(var(--colors-gray-400),var(--tw-text-opacity));
}
</style>
<style scoped>
.container {
  cursor: pointer;
  display: flex;
  align-items: center;
}

.container.text-left {
  justify-content: flex-start;
}
.container.text-center {
  justify-content: center;
}
.container.text-right {
  justify-content: flex-end;
}

.label {
  margin-left: 12px;
  color: rgba(var(--colors-gray-500),var(--tw-text-opacity));
  /* Show an ellipsis if the text takes more than one line */
}

/* Visually hide the checkbox input */
.input {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  white-space: nowrap;
  border-width: 0;
}

.switch {
  --switch-container-width: 50px;
  --switch-size: calc(var(--switch-container-width) / 2);

  --light-gray: rgb(var(--colors-gray-200));
  --gray: rgb(var(--colors-gray-300));
  --dark-gray: rgb(var(--colors-gray-400));
  --teal: rgb(var(--colors-green-500));
  --dark-teal: rgb(var(--colors-green-500));

  /* Vertically center the inner circle */
  display: flex;
  align-items: center;
  position: relative;
  height: var(--switch-size);
  flex-basis: var(--switch-container-width);
  /* Make the container element rounded */
  border-radius: var(--switch-size);
  background-color: var(--light-gray);
  /* In case the label gets really long, the toggle shouldn't shrink. */
  flex-shrink: 0;

  transition: background-color 0.2s ease-in-out;
}

.switch::before {
  content: "";
  position: absolute;
  /* Move a little bit the inner circle to the right */
  left: 1px;
  height: calc(var(--switch-size) - 4px);
  width: calc(var(--switch-size) - 4px);
  /* Make the inner circle fully rounded */
  border-radius: 9999px;
  background-color: white;
  border: 2px solid var(--light-gray);

  transition: transform 0.2s ease-in-out;
}

.input:checked + .switch {
  background-color: var(--teal);
}

.input:checked + .switch::before {
  border-color: var(--teal);
  /* Move the inner circle to the right */
  transform: translateX(
      calc(var(--switch-container-width) - var(--switch-size))
  );
}

.input:focus + .switch::before {
  border-color: var(--gray);
}

.input:focus:checked + .switch::before {
  border-color: var(--dark-teal);
}

.input:disabled + .switch {
  background-color: var(--gray);
}

.input:disabled + .switch::before {
  background-color: var(--dark-gray);
  border-color: var(--dark-gray);
}
</style>