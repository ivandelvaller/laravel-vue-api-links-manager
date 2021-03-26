<template>
    <div class="h-screen w-screen bg-black bg-opacity-5 z-5 flex flex-col justify-center items-center">
        <div class="z-10 bg-green-500">
        <slot></slot>
        <div class="rounded">
            <button @click="$emit('on-accept', info)">Accept</button>
            <button @click="$emit('on-cancel')">Cancel</button>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    data: function () {
        return {
            info: {}
        }
    } 
}
</script>