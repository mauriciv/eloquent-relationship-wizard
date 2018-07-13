<template>
    <div class="bg-red flex p-3 flex-col items-center rounded">
        <span class="text-white mb-3" v-if="className">{{ className }}.php</span>
        <pre class="rounded bg-grey-light p-3"><code><?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class {{ className }} extends Model
{
    public function {{ functionName }}()
    {
        return $this->{{ relationshipFunction }}({{ childClassName }}::class);
    }
}
</code></pre>
    </div>
</template>

<script>
    export default {
        props: {
            parent: String,
            child: String,
            relationship: String,
        },
        data() {
            return {
            };
         },
        computed: {
            className() {
                return _.capitalize(this.parent);
            },
            functionName() {
                if (this.relationship === 'one to one') return this.child;

                return pluralize(this.child);
            },
            relationshipFunction() { 
                if (this.relationship === 'one to one') return 'hasOne';
                if (this.relationship === 'one to many') return 'hasMany';
                if (this.relationship === 'many to many') return 'belongsToMany';
            },
            childClassName() {
                return _.capitalize(this.child);
            },
            sourceCode() {
            }
        },
    }
</script>
