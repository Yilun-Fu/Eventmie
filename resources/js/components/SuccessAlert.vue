<template>
    <b-alert
        :variant="variant"
        show
        dismissible
        @dismissed="dismiss"
    >
        {{ message }}
    </b-alert>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true
        },
        variant: {
            type: String,
            default: 'success'
        }
    },
    methods: {
        dismiss() {
            this.$emit('close');
        }
    }
}
</script>
