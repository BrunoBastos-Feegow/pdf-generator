<!--resources/js/components/Tiptap.vue-->
<template>
    <div>
        <div class="menu flex space-x-2 mb-2">
            <button class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-md flex items-center justify-center text-bold"
                    @click="editor.chain().focus().toggleBold().run()">
                <span class="font-bold">B</span>
            </button>
            <button class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-md flex items-center justify-center"
                    @click="editor.chain().focus().toggleItalic().run()">
                <span class="italic">I</span>
            </button>
            <button class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-md flex items-center justify-center"
                    @click="editor.chain().focus().toggleUnderline().run()">
                <span class="underline">U</span>
            </button>
            <input type="file" ref="imageUploader" style="display: none" @change="uploadImage"/>
            <button class="w-8 h-8 bg-gray-200 hover:bg-gray-300 rounded-md flex items-center justify-center"
                    @click="addImage">
                <span>🖼️</span>
            </button>
        </div>
        <editor-content :editor="editor"/>
    </div>
</template>

<script>
import StarterKit from '@tiptap/starter-kit'
import {Editor, EditorContent} from '@tiptap/vue-3'
import Underline from '@tiptap/extension-underline'
import Link from "@tiptap/extension-link";
import Image from '@tiptap/extension-image';

export default {
    components: {
        EditorContent,
    },

    props: {
        modelValue: {
            type: String,
            default: '',
        },
    },
    emits: ['update:modelValue'],
    data() {
        return {
            editor: null,
        }
    },
    watch: {
        modelValue(value) {
            const isSame = this.editor.getHTML() === value
            if (isSame) {
                return
            }
            this.editor.commands.setContent(value, false)
        },
    },
    mounted() {
        this.editor = new Editor({
            extensions: [
                StarterKit,
                Underline,
                Image,
                Link.configure({
                    openOnClick: true,
                    defaultTarget: '_blank',
                }),
            ],
            content: this.modelValue,
            editorProps: {
                attributes: {
                    class: 'ProseMirror border-2 border-gray-300 rounded-md p-2 h-80',
                },
            },
            onUpdate: () => {
                this.$emit('update:modelValue', this.editor.getHTML())
            },
        })
    },
    beforeUnmount() {
        this.editor.destroy()
    },
    methods: {
        addImage() {
            const url = prompt('URL da imagem:');
            if (url) {
                this.editor.chain().focus().setImage({src: url}).run();
            }
        },
        triggerImageUpload() {
            this.$refs.imageUploader.click();
        },
        async uploadImage(event) {
            const file = event.target.files[0];
            if (file) {
                const imageUrl = await this.uploadToServer(file);
                if (imageUrl) {
                    this.editor.chain().focus().setImage({src: imageUrl}).run();
                }
            }
        }
    }
}
</script>
<style lang="scss" scoped>
/* Basic editor styles */
.tiptap {
    > * + * {
        margin-top: 0.75em;
    }

    code {
        background-color: rgba(#616161, 0.1);
        color: #616161;
    }

    /* remove outline */
    .ProseMirror:focus {
        outline: none;
    }

    /* set */
    .ProseMirror {
        min-height: 100px;
        max-height: 100px;
        overflow: scroll;
    }
}


.content {
    padding: 1rem 0 0;

    h3 {
        margin: 1rem 0 0.5rem;
    }

    pre {
        border-radius: 5px;
        color: #333;
    }

    code {
        display: block;
        white-space: pre-wrap;
        font-size: 0.8rem;
        padding: 0.75rem 1rem;
        background-color: #e9ecef;
        color: #495057;
    }
}
</style>
