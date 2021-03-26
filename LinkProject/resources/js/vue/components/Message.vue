<template>
    <div :class="`bg-${color}-400`">
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