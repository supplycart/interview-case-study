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
    brands: Array,
})

const { brands } = props

// Stores
const filterStore = useFilterStore()
</script>

<template>
    <div class="flex flex-col gap-2">
        <Label>Brand</Label>
        <Select v-model="filterStore.selectedBrand">
            <SelectTrigger>
                <SelectValue placeholder="Filter by Brand" />
            </SelectTrigger>
            <SelectContent>
                <SelectGroup>
                    <SelectLabel>Brands</SelectLabel>
                    <SelectItem value="all"> All Brands </SelectItem>
                    <SelectItem
                        v-for="brand in brands"
                        :key="brand"
                        :value="brand"
                    >
                        {{ brand }}
                    </SelectItem>
                </SelectGroup>
            </SelectContent>
        </Select>
    </div>
</template>
