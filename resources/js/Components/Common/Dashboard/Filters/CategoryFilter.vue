<script setup>
import { Label } from '@/Components/ui/label'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select'
import { useFilterStore } from '@/Stores/filterStore'

// Define Props
const props = defineProps({
    categories: Array,
})

const { categories } = props

// Stores
const filterStore = useFilterStore()
</script>

<template>
    <div class="flex flex-col gap-2">
        <Label>Category</Label>
        <Select v-model="filterStore.selectedCategory">
            <SelectTrigger>
                <SelectValue placeholder="Filter by Category" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectLabel>Categories</SelectLabel>
                    <SelectItem value="all"> All Categories </SelectItem>
                    <SelectItem
                        v-for="category in categories"
                        :key="category"
                        :value="category"
                    >
                        {{ category }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
    </div>
</template>
