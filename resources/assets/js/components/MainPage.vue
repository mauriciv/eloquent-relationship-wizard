<template>
    <div class="rounded">
        <div class="flex flex-col p-3 text-lg">
            <div class="flex justify-center">
                <span class="m-1" dusk="parent-indefinite-article">{{ parentIndefiniteArticle }}</span>
                <input class="m-1 rounded" type="text" placeholder="parent" v-model="parent" dusk="parent-input">
                <select class="m-1 bg-white rounded" v-model="has">
                    <option value="one">has one</option>
                    <option value="many">has many</option>
                </select>
                <code class="m-1" v-text="childText"></code>
            </div>
            <div class="flex justify-center">
                <span class="m-1">and</span>
                <span class="m-1" dusk="child-indefinite-article">{{ childIndefiniteArticle }}</span>
                <input class="m-1 rounded" type="text" placeholder="child" v-model="child" dusk="child-input">
                <span class="m-1" v-if="has === 'one'">belongs to one</span>
                <select class="m-1 bg-white rounded" v-if="has == 'many'" v-model="belongsTo">
                    <option value="one">belongs to one</option>
                    <option value="many">belongs to many</option>
                </select>
                <code class="m-1" v-text="parentText"></code>
            </div>
        </div>
        <migration-tables class="m-1" :relationship="relationship" :parent="parent" :child="child"></migration-tables>
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
import EloquentModelParent from "./EloquentModelParent";
import EloquentModelChild from "./EloquentModelChild";
import MigrationTables from "./MigrationTables";
import a from "indefinite";
export default {
    components: { EloquentModelParent, EloquentModelChild, MigrationTables },
    data() {
        return {
            parent: "",
            child: "",
            has: "one",
            belongsTo: "one"
        };
    },
    computed: {
        childText() {
            if (this.has === "one") {
                return this.child;
            }
            return pluralize(this.child);
        },
        parentText() {
            if (this.belongsTo === "one") {
                return this.parent;
            }
            return pluralize(this.parent);
        },
        relationship() {
            if (this.has == "one") return "one to one";
            if (this.has == "many" && this.belongsTo == "one")
                return "one to many";
            return "many to many";
        },
        parentIndefiniteArticle() {
            return a(this.parent, { capitalize: true }).split(" ")[0];
        },
        childIndefiniteArticle() {
            return a(this.child, { capitalize: false }).split(" ")[0];
        }
    }
};
</script>
