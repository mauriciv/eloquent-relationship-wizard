<template>
    <div class="flex flex-col items-center mt-5">
        <span class="text-xl mb-3 font-bold">Migrations</span>
        <div class="flex text-sm">
            <migration-parent class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-parent>
            <migration-child class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-child>
        </div>
        <migration-pivot v-if="relationship === 'many to many'" 
                         class="m-1" 
                         :relationship="relationship" 
                         :parent="parent" 
                         :child="child" 
                         :parentTableName="parentTableName" 
                         :childTableName="childTableName"
                         ></migration-pivot>
    </div>
</template>

<script>
    import MigrationParent from './MigrationParent';
    import MigrationChild from './MigrationChild';
    import MigrationPivot from './MigrationPivot';
    export default {
        components: { MigrationParent, MigrationChild, MigrationPivot },
        props: {
            parent: String,
            child: String,
            relationship: String,
        },
        computed: {
            parentTableName() {
                return pluralize(this.parent);
            },
            childTableName() {
                return pluralize(this.child);
            },
        },
    }
</script>
