<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'

import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
} from '@/components/ui/card';

interface Props {
    activity_logs: any;
}

const props = defineProps<Props>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Activity Log',
        href: '/user/activity-log',
    },
];
</script>

<template>
    <Head title="ActivityLog" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">

            <Card>
                <CardHeader>
                    <CardDescription>
                        <strong>ActivityLog Listing</strong>
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <Table v-if="props.activity_logs.data.length > 0">
                        <TableHeader>
                            <TableRow>
                                <TableHead>#</TableHead>
                                <TableHead>Description</TableHead>
                                <TableHead>Created At</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="(activitylog, index) in props.activity_logs.data">
                                <TableCell>{{ index + 1 }}</TableCell>
                                <TableCell class="font-medium">{{ activitylog.description }}</TableCell>
                                <TableCell>{{ activitylog.created_at }}</TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>

                    <div v-if="props.activity_logs.data.length <= 0">
                        ActivityLog is empty
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
