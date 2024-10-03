<script setup>
import { FilterMatchMode } from '@primevue/core/api';
import { ref } from 'vue'

defineProps({
    posts: {
        type: Array,
    },
});

const filters = ref({});
const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        title: { value: null, matchMode: FilterMatchMode.CONTAINS },
    }
}
initFilters();
const clearFilter = () => {
    initFilters();
}
</script>
<template>
    
    <h2
        class="text-xl font-semibold leading-tight text-gray-800"
    >
        Posts
    </h2>
    <DataTable
        v-model:filters="filters"
        :value="posts"
        paginator
        :rows="10"
        tableStyle="min-width: 50rem"
        :globalFilterFields="['title']"
    >
        <template #header>
            <div class="flex justify-center md:justify-end">
                <IconField>
                    <InputIcon>
                        <i class="pi pi-search" />
                    </InputIcon>
                    <InputText v-model="filters['global'].value" placeholder="Search by Title" />
                    <InputIcon class="cursor-pointer" @click="clearFilter()">
                        <i class="pi pi-times" />
                    </InputIcon>
                </IconField>
            </div>
        </template>
        <Column field="post_id" header="ID"></Column>
        <Column field="user_id" header="User"></Column>
        <Column field="title" header="Title"></Column>
        <Column field="body" header="Body"></Column>
    </DataTable>
</template>