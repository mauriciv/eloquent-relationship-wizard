<template>
    <div class="bg-blue flex p-3 flex-col items-center rounded">
        <span class="text-white mb-3" v-if="className">{{ className }}.php</span>
        <pre class="rounded bg-grey-light p-3"><code><?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class {{ className }} extends Model
{
    public function {{ functionName }}()
    {
        return $this->{{ relationshipFunction }}({{ parentClassName }}::class);
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
                return _.capitalize(this.child);
            },
            functionName() {
                if (this.relationship === 'many to many') return pluralize(this.parent);

                return this.parent;
            },
            relationshipFunction() { 
                if (this.relationship === 'many to many') return 'belongsToMany';
                return 'belongsTo';
            },
            parentClassName() {
                return _.capitalize(this.parent);
            },
            sourceCode() {
            }
        },
    }
</script>
