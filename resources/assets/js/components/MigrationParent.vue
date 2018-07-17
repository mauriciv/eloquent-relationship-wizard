<template>
    <div class="bg-red flex p-3 flex-col items-center rounded">
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
            $table->timestamps();
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
        },
        computed: {
            className() {
                return `Create${_.capitalize(this.tableName)}Table`;
            },
            fileName() {
                if (!this.parent) return '';
                return moment().format('YYYY_MM_DD_kkmmss') + `_create_${this.tableName}_table`;
            },
            tableName() {
                return pluralize(this.parent);
            },
            childClassName() {
                return _.capitalize(this.child);
            },
            primaryKeyName() {

            }
        },
    }
</script>
