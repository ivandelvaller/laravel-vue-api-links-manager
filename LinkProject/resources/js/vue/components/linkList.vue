<template>
    <ul>
        <li v-for="link in links" :key="link.id">
            <link-list-item link="link"/>
        </li>
    </ul>
</template>

<script>
import axios from 'axios';

import LinkListItem from './linkListItem';

export default {
    name: 'LinkList',
    props: [ 'links' ]
}
</script>