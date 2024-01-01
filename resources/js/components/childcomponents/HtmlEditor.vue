<template>
    <div id="editor">
        <Editor
        api-key="clmdlw8dthoezrtl15yc8r7lpfl5kv9ykb9ricik3k0iwbd4"
        :init="{
            plugins: 'lists link image table code help wordcount'
        }"
        v-model="editorText"
        @blur="onEmit"
        /> 
    </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue'
    
    export default {
        name: 'editor',
        components: {
            Editor
        },
        data() {
            return {
                editorText: ''
            };
        },
        methods: {
            onEmit() 
            {
                this.emitter.emit('editor-text', this.editorText);
            }
        }, 
        mounted() {
            // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
            // E V E N T S
            // - Text einlesen - PROJEKT 
            let self = this
            self.emitter.on('projecttext-loaded', (item) => {
                self.editorText = item
            });                
            self.emitter.on('methodtext-loaded', (item) => {
                self.editorText = item
            });                
        }

    }
</script>
<style scoped>

</style>