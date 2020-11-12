<template>
    <div>
        <h3 class="is-center">Welcome to our dashboard</h3>
    </div>
</template>

<script>
    /* Layout */
    import Layout from '@/Layouts/general';

    export default {
        layout: Layout,
        props: {
            user: Object,
        },
    }
</script>
