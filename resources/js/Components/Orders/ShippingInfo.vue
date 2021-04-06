<template>
    <div class="col-span-1 lg:col-span-6">
        <div class="p-4 bg-gray-100 rounded-full">
            <h1 class="ml-2 font-bold uppercase text-center">Shipping Information</h1>
        </div>
        <div class="p-4 bg-white">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                        <input type="text" v-model="form.first_name" name="first_name" id="first_name" placeholder="First name" required autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                        <input type="text" v-model="form.last_name" name="last_name" id="last_name" placeholder="Last name" required autocomplete="family-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="country" class="block text-sm font-medium text-gray-700">Country / Region</label>
                        <select id="country" v-model="form.country" name="country" required autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Malaysia</option>
                        </select>
                    </div>
                    <div class="col-span-6">
                        <label for="street_address" class="block text-sm font-medium text-gray-700">Street address</label>
                        <input type="text" v-model="form.street_address" name="street_address" id="street_address" placeholder="Street address" required autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" v-model="form.city" name="city" id="city" placeholder="City" required autocomplete="city" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="state" class="block text-sm font-medium text-gray-700">State / Province</label>
                        <input type="text" v-model="form.state" name="state" id="state" placeholder="State / Province" required autocomplete="state" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                        <label for="postcode" class="block text-sm font-medium text-gray-700">ZIP / Postcode</label>
                        <input type="text" v-model="form.postcode" name="postcode" id="postcode" placeholder="ZIP / Postcode" required autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone number</label>
                        <input type="text" v-model="form.phone_number" name="phone_number" id="phone_number" placeholder="Phone number" required autocomplete="phone-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="col-span-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea id="notes" v-model="form.notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Special notes"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'form',
    ],
}
</script>
