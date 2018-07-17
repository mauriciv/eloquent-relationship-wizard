<template>
    <div class="bg-purple flex p-3 flex-col items-center rounded">
        <span class="text-white mb-3" v-if="fileName">{{ fileName }}.php</span>
        <pre class="rounded bg-grey-light p-3"><code><?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class {{ className }} extends Migration
{
    public function up()
    {
        Schema::create('{{ tableName }}', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('{{ parent }}_id')->unsigned()->index();
            $table->foreign('{{ parent }}_id')->references('id')->on('{{ parentTableName }}');

            $table->integer('{{ child }}_id')->unsigned()->index();
            $table->foreign('{{ child }}_id')->references('id')->on('{{ childTableName }}s');
        });
    }

    public function down()
    {
        Schema::dropIfExists('{{ tableName }}');
    }
}</code></pre>
    </div>
</template>

<script>

    export default {
        props: {
            parent: String,
            child: String,
            relationship: String,
            parentTableName: String,
            childTableName: String,
        },
        computed: {
            className() {
                let words = this.tableName.split('_');
                let className = _.capitalize(words[0]) + _.capitalize(words[1]);
                return `Create${className}Table`;
            },
            fileName() {
                if (!this.parent) return '';
                return moment().format('YYYY_MM_DD_kkmmss') + `_create_${this.tableName}_table`;
            },
            tableName() {
                if (this.parent <= this.child) {
                    return this.parent + '_' + this.child;
                }
                return this.child + '_' + this.parent;
            },
            childClassName() {
                return _.capitalize(this.child);
            },
        },
    }
</script>
