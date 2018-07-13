<template>
    <div class="rounded">
        <div class="flex flex-col p-3 text-lg">
            <div class="flex justify-center">
                <span class="m-1">{{ indefiniteArticle }}</span>
                <input class="m-1 rounded" type="text" placeholder="parent" v-model="parent">
                <select class="m-1 bg-white rounded" v-model="has">
                    <option value="one">has one</option>
                    <option value="many">has many</option>
                </select>
                <code class="m-1" v-text="childText"></code>
            </div>
            <div class="flex justify-center">
                <span class="m-1">and a</span>
                <input class="m-1 rounded" type="text" placeholder="child" v-model="child">
                <span class="m-1" v-if="has === 'one'">belongs to one</span>
                <select class="m-1 bg-white rounded" v-if="has == 'many'" v-model="belongsTo">
                    <option value="one">belongs to one</option>
                    <option value="many">belongs to many</option>
                </select>
                <code class="m-1" v-text="parentText"></code>
            </div>
        </div>
        <div class="flex flex-col items-center mt-5">
            <span class="text-xl mb-3 font-bold">Migrations</span>
            <div class="flex text-sm">
                <migration-parent class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-parent>
                <migration-child class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-child>
            </div>
            <migration-pivot v-if="relationship === 'many to many'" class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-pivot>
        </div>
        <div class="flex flex-col items-center mt-5">
            <span class="text-xl mb-3 font-bold">Eloquent Models</span>
            <div class="flex">
                <eloquent-model-parent class="m-1" :relationship="relationship" :parent="parent" :child="child"></eloquent-model-parent>
                <eloquent-model-child class="m-1" :relationship="relationship" :parent="parent" :child="child"></eloquent-model-child>
            </div>
        </div>
    </div>
</template>

<script>
    import EloquentModelParent from './EloquentModelParent';
    import EloquentModelChild from './EloquentModelChild';
    import MigrationParent from './MigrationParent';
    import MigrationChild from './MigrationChild';
    import MigrationPivot from './MigrationPivot';
    import a from 'indefinite';
    export default {
        components:{EloquentModelParent, EloquentModelChild, MigrationParent, MigrationChild, MigrationPivot},
        data() {
            return {
                parent: '',
                child: '',
                has: 'one',
                belongsTo: 'one'
            }
        },
        computed: {
            childText() {
                if (this.has === 'one') {
                    return this.child;
                }
                return pluralize(this.child);
            },
            parentText() {
                if (this.belongsTo === 'one') {
                    return this.parent;
                }
                return pluralize(this.parent);
            },
            relationship() {
                if (this.has == 'one') return 'one to one';
                if (this.has == 'many' && this.belongsTo == 'one') return 'one to many';
                return 'many to many';
            },
            indefiniteArticle() {
                return a(this.parent, {capitalize: true}).split(' ')[0];
            }
        }
    }
</script>
