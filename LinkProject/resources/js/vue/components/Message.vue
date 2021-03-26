<template>
    <div :class="`text-${color}-300`">
        <slot></slot>
    </div>
</template>

<script>
export default {
    name: 'Message',
    props: {
        color: {
            type: String
        }
    }
}
</script>