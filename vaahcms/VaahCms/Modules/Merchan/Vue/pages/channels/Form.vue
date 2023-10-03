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
                               name="channels-url"
                               data-testid="channels-url"
                               v-model="store.item.url"/>
                </VhField>

                <VhField label="Type">
                    <Dropdown v-model="store.item.meta.type" :options="store.assets.channel_type"
                              option-value="name"
                              optionLabel="name"
                              @change="store.resetApiKeys()"
                              placeholder="Select Type" class="w-full" />
                </VhField>

                <VhField v-if="store.item.meta && store.item.meta.type == 'Shopify'">

                <Fieldset

                    legend="URL">
                    <InputText class="w-full margin-fieldset"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.url"/>

                </Fieldset>

                </VhField>

                <VhField v-if="store.item.meta && store.item.meta.type == 'Shopify'
                     || store.item.meta.type == 'WooCommerce'">

                <Fieldset legend="Admin API Token">
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.admin_api_token"/>
                </Fieldset>

                    </VhField >

                <VhField v-if="store.item.meta && store.item.meta.type == 'Shopify'
                    || store.item.meta.type == 'WooCommerce'
                    || store.item.meta.type == 'Bigcommerce'">

                <Fieldset legend="API Key">
                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.api_key"/>
                </Fieldset>

                    </VhField >

                <VhField v-if="store.item.meta && store.item.meta.type == 'Shopify'
                     || store.item.meta.type == 'WooCommerce'
                     || store.item.meta.type == 'Bigcommerce'">

                <Fieldset legend="API Secret" class="w-full">

                    <InputText class="w-full"
                               name="channels-shopify-url"
                               data-testid="channels-shopify-url"
                               v-model="store.item.meta.api_secret"/>
                </Fieldset>

                    </VhField >


                <VhField label="Notes">
                    <Textarea class="w-full"
                              name="customers-notes"
                              data-testid="customers-notes"
                              v-model="store.item.notes"/>
                </VhField>

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
<style scoped>
.p-fieldset, .p-fieldset .fieldset-legend
{
    border-color:white;
}
</style>
