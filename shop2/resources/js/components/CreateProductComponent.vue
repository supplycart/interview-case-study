<template>
    <div class="flex justify-center m-5">
        <form method="POST" enctype="multipart/form-data" class="w-full max-w-lg" @submit.prevent="createProduct">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label for="productcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product Name</label>
                    <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="Beef Burger" v-model="form.name">
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label for="productcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product Price</label>
                    <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" placeholder="10.00" v-model="form.price">
                </div>
                <div class="w-full w-full px-3 mt-2">
                    <label for="productcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product Category</label>
                    <select type="text" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" v-model="form.category_id">
                        <option  v-for="category in this.categories" :value="category.id">{{category.categoryname}}</option>
                    </select>
                </div>
                <div class="w-full w-full px-3 pt-4">
                    <label for="productcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product Subcategory</label>
                    <select type="text" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:shadow-outline" v-model="form.subcategory_id">
                        <option :value="subcategory.id" v-for="subcategory in filteredSubcategories">{{subcategory.subcategoryname}}</option>
                    </select>
                </div>
            </div>
            <br>
            <div v-if="imagePreview" class="flex justify-center">
                <img :src="imagePreview" class="w-32 m-2" alt="previewImage">
            </div>
            <div class="w-full block items-center bg-grey-lighter">
                <input type="file" id="customFile" class="hidden" @change="imageSelected">
                <label class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-blue hover:text-white" for="customFile">Choose an Image</label>
            </div>
            <br>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label for="productcategory" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Product Description</label>
                    <input type="textarea" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Product Description" v-model="form.shortdescription">
                </div>
            </div>
            <button type="submit" class="px-4 py-2 text-center bg-blue-500 hover:bg-blue-700 text-white font-bold rounded w-full">Submit new product</button>
        </form>
    </div>
</template>
<script>
export default {

    props: ['categories','subcategories'],

    data(){
        return{
            form : new Form({
                name: '',
                price: '',
                category_id: '',
                subcategory_id: '',
                shortdescription: '',
            }),
            image: null,
            imagePreview: null,
        }
    },

    computed: {
        filteredSubcategories: function(){
            return this.subcategories.filter((sub) => sub.category_id == this.form.category_id);
        }
    },

    methods: {
        imageSelected(e){
            this.image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.imagePreview = e.target.result;
            };
        },

        createProduct(){
            let data = new FormData;
            data.append('image', this.image);
            data.append('name', this.form.name);
            data.append('price', this.form.price);
            data.append('shortdescription', this.form.shortdescription);
            data.append('category_id', this.form.category_id);
            data.append('subcategory_id', this.form.subcategory_id);

            axios.post('../product', data)
            .then((Response)=>{
                //this.form.reset();
                window.location = '../admin';
            }).catch(error => this.form.errors.record(error.response.data));

        }
    }

    
}
</script>