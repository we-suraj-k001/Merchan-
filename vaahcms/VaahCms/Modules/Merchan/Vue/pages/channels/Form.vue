<script setup>
import {onMounted, ref, watch} from "vue";
import { useChannelStore } from '../../stores/store-channels'

import VhField from './../../vaahvue/vue-three/primeflex/VhField.vue'
import {useRoute} from 'vue-router';


const store = useChannelStore();
const route = useRoute();

onMounted(async () => {
    if(route.params && route.params.id)
    {
        await store.getItem(route.params.id);
    }

    await store.getFormMenu();
});

//--------form_menu
const form_menu = ref();
const toggleFormMenu = (event) => {
    form_menu.value.toggle(event);
};
//--------/form_menu

</script>
<template>

    <div class="col-6" >

        <Panel class="is-small">

            <template class="p-1" #header>


                <div class="flex flex-row">
                    <div class="p-panel-title">
                        <span v-if="store.item && store.item.id">
                            Update
                        </span>
                        <span v-else>
                            Create
                        </span>
                    </div>

                </div>


            </template>

            <template #icons>


                <div class="p-inputgroup">
                    <Button label="Save"
                            class="p-button-sm"
                            v-if="store.item && store.item.id"
                            data-testid="channels-save"
                            @click="store.itemAction('save')"
                            icon="pi pi-save"/>

                    <Button label="Create & New"
                            v-else
                            @click="store.itemAction('create-and-new')"
                            class="p-button-sm"
                            data-testid="channels-create-and-new"
                            icon="pi pi-save"/>


                    <!--form_menu-->
                    <Button
                        type="button"
                        @click="toggleFormMenu"
                        class="p-button-sm"
                        data-testid="channels-form-menu"
                        icon="pi pi-angle-down"
                        aria-haspopup="true"/>

                    <Menu ref="form_menu"
                          :model="store.form_menu_list"
                          :popup="true" />
                    <!--/form_menu-->


                    <Button class="p-button-primary p-button-sm"
                            icon="pi pi-times"
                            data-testid="channels-to-list"
                            @click="store.toList()">
                    </Button>
                </div>



            </template>


            <div v-if="store.item" class="pt-2">

                <VhField label="Name">
                    <InputText class="w-full"
                               name="channels-name"
                               data-testid="channels-name"
                               @update:modelValue="store.watchItem"
                               v-model="store.item.name"/>
                </VhField>

                <VhField label="Slug">
                    <InputText class="w-full"
                               name="channels-slug"
                               data-testid="channels-slug"
                               v-model="store.item.slug"/>
                </VhField>

                <VhField label="Customer Name">

                    <AutoComplete name="channels-customer-name"
                                  data-testid="channels-customer-name"
                                  v-model="store.item.customer"
                                  option-label = "name"
                                  dropdown
                                  :suggestions="store.customers"
                                  @complete="store.searchCustomers"
                                  @change="store.selectCustomerId"
                                  class="w-full"
                    />
                </VhField>

                <VhField label="Primary Locale">
                    <Dropdown v-model="store.item.locale" :options="store.assets.locale"
                              option-value="name"
                              optionLabel="name" placeholder="Select Locale" class="w-full" />
                </VhField>

                <VhField label="Default Currency">
                    <Dropdown v-model="store.item.currency" :options="store.assets.currency"
                              option-value="name"
                              optionLabel="name" placeholder="Select Currency" class="w-full" />
                </VhField>

                <VhField label="Store URL">
                    <InputText class="w-full"
                               name="channels-name"
                               data-testid="channels-name"
                               @update:modelValue="store.watchItem"
                               v-model="store.item.name"/>
                </VhField>

                <VhField label="Type">
                    <Dropdown v-model="store.item.type" :options="store.assets.channel_type"
                              option-value="name"
                              optionLabel="name" placeholder="Select Type" class="w-full" />
                </VhField>

                <Fieldset
                    v-if="store.item.type == 'Shopify'"
                    legend="URL">
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.url"/>
                </Fieldset>
                <br/>
                <Fieldset
                    v-if="store.item.type == 'Shopify'
                     || store.item.type == 'WooCommerce'"
                    legend="Admin API Token" class="w-full" >
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.admin_api_token"/>
                </Fieldset>
                <br/>
                <Fieldset
                    v-if="store.item.type == 'Shopify'
                    || store.item.type == 'WooCommerce'
                    || store.item.type == 'Bigcommerce'"
                    legend="API Key" >
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.api_key"/>
                </Fieldset>
                <br/>
                <Fieldset
                    legend="API Secret" class="w-full"
                    v-if="store.item.type == 'Shopify'
                     || store.item.type == 'WooCommerce'
                     || store.item.type == 'Bigcommerce'">
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.api_secret"/>
                </Fieldset>
                <br/>
                <VhField label="Is Active">
                    <InputSwitch v-bind:false-value="0"
                                 v-bind:true-value="1"
                                 class="p-inputswitch-sm"
                                 name="channels-active"
                                 data-testid="channels-active"
                                 v-model="store.item.is_active"/>
                </VhField>

            </div>
        </Panel>

    </div>

</template>
