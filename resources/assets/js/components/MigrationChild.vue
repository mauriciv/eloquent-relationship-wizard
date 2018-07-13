<template>
    <div class="bg-blue flex p-3 flex-col items-center rounded">
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
            $table->timestamps();<span v-if="relationship !== 'many to many'">
            $table->unsignedInteger('{{ parent }}_id')->index();
            $table->foreign('{{ parent }}_id')->references('id')->on('{{ parentTableName }}');</span>
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
                return `Create${_.capitalize(pluralize(this.child))}Table`;
            },
            fileName() {
                if (!this.child) return '';
                return moment().format('YYYY_MM_DD_kkmmss') + `_create_${pluralize(this.child)}_table`;
            },
            tableName() {
                return pluralize(this.child);
            },
            parentTableName() {
                return pluralize(this.parent);
            },
        },
    }
</script>
