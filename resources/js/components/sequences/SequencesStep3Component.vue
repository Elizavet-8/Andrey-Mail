<template>
    <div class="new__content step-3">
        <div class="new__content-table">
            <div class="new__content-table-row">
                <div class="new__content-table-row-cell"></div>
                <div class="new__content-table-row-cell">Name</div>
                <div class="new__content-table-row-cell">Email</div>
                <div class="new__content-table-row-cell"></div>
            </div>
            <div class="new__content-table-row" v-for="(item, index) in sequence.recipients">
                <div class="new__content-table-row-cell">{{ index + 1 }}</div>
                <div class="new__content-table-row-cell">{{ item.name }}</div>
                <div class="new__content-table-row-cell">{{ item.email }}</div>
                <div class="new__content-table-row-cell"></div>
            </div>
        </div>
        <div class="new__content-stages" v-for="(item, index) in sequence.stages">
            <h3 class="h3 new__content-stages-theme">Письмо {{ index + 1 }}: {{ sequence.stages[0][0]['subject'] }}</h3>
            <p class="new__content-stages-time" v-if="index !== 0">if stage {{ index }} not replied in {{ item[0]['actionTime'] }} {{ item[0]['action'] }}</p>
            <p class="new__content-stages-content" v-html="item[0]['content']"></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "SequencesStep3Component",
    props: ['sequence'],

}
</script>
