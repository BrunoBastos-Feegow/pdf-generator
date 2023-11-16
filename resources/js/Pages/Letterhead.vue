<!--resources/js/Pages/Letterhead.vue-->
<template>
    <div class="container page-config">
        <div class="page" ref="page" :style="pageStyle">
            <div id="top-margin-line" class="margin horizontal"
                 :style="{top: `${letterhead.mTop}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('top', $event)">
                <span class="distance-label">{{ (letterhead.mTop/2).toFixed(0) }} mm</span>
            </div>
            <div id="bottom-margin-line" class="margin horizontal"
                 :style="{bottom: `${letterhead.mBottom}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('bottom', $event)">
                <span class="distance-label">{{ (letterhead.mBottom/2).toFixed(0) }} mm</span>
            </div>
            <div id="left-margin-line" class="margin vertical"
                 :style="{left: `${letterhead.mLeft}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('left', $event)">
                <span class="distance-label">{{ (letterhead.mLeft/2).toFixed(0) }} mm</span>
            </div>
            <div id="right-margin-line" class="margin vertical"
                 :style="{right: `${letterhead.mRight}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('right', $event)">
                <span class="distance-label">{{ (letterhead.mRight/2).toFixed(0) }} mm</span>
            </div>

            <div v-if="letterhead.useHeader" id="header-height-line" class="element height"
                 :style="{top: `${letterhead.mTop + letterhead.headerHeight}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('header', $event)">
                <span class="distance-label">{{ (letterhead.headerHeight/2).toFixed(0) }} mm</span>
            </div>
            <div v-if="letterhead.useHeader" class="header-content border-2 border-dashed border-gray-300"
                 :style="{fontSize: `${scaledFontSize}px`, height: `${letterhead.headerHeight}px`, top: `${letterhead.mTop}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}">
                <span v-if="!headerText && !headerImage" @click="openHeaderEditor">Clique para editar o cabeçalho</span>
                <span v-else @click="openHeaderEditor" v-html="headerText"></span>
                <img v-if="headerImage" :src="headerImage" alt="Imagem do Cabeçalho"/>
            </div>

            <div v-if="letterhead.useFooter" id="footer-height-line" class="element height"
                 :style="{bottom: `${letterhead.mBottom + letterhead.footerHeight}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('footer', $event)">
                <span class="distance-label">{{ (letterhead.footerHeight/2).toFixed(0) }} mm</span>
            </div>
            <div v-if="letterhead.useFooter" class="footer-content border-2 border-dashed border-gray-300"
                 :style="{fontSize: `${scaledFontSize}px`, height: `${letterhead.footerHeight}px`, bottom: `${letterhead.mBottom}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}">
                <span v-if="!footerText && !footerImage" @click="openFooterEditor">Clique para editar o rodapé</span>
                <span v-else @click="openFooterEditor" v-html="footerText"></span>
                <img v-if="footerImage" :src="footerImage" alt="Imagem do Rodapé"/>
            </div>
        </div>

        <div class="config-panel flex flex-col space-y-4 mr-6">
            <div>
                <label for="nome-modelo" class="block text-sm font-medium text-gray-700">Nome do Modelo</label>
                <input v-model.lazy="letterhead.NomeModelo"
                       type="text"
                       id="nome-modelo"
                       name="nome-modelo"
                       autocomplete="nome-modelo"
                       class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>

            </div>
            <label class="flex items-center space-x-2 justify-between">
                <span class="text-sm font-medium">Usar Cabeçalho</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox"
                           v-model="letterhead.useHeader"
                           v-bind:true-value="1"
                           v-bind:false-value="0"
                           class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label for="toggle"
                           class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
            <label class="flex items-center space-x-2 justify-between">
                <span class="text-sm font-medium">Usar Rodapé</span>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox"
                           v-model="letterhead.useFooter"
                           v-bind:true-value="1"
                           v-bind:false-value="0"
                           class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label for="toggle"
                           class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </label>
            <div>
                <label for="paper-size" class="block text-sm font-medium text-gray-700">Tamanho do Papel</label>
                <select v-model="letterhead.paperSize"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                    <option value="A4">A4</option>
                    <option value="Letter">Letter</option>
                    <option value="A3">A3</option>
                    <option value="A5">A5</option>
                    <option value="A6">A6</option>
                    <option value="custom">Personalizado</option>
                </select>
                <div v-if="letterhead.paperSize === 'custom'" class="mt-2">
                    <label class="text-sm font-medium text-gray-700">Largura (mm)</label>
                    <input v-model="letterhead.customWidth" type="number"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <label class="mt-2 text-sm font-medium text-gray-700">Altura (mm)</label>
                    <input v-model="letterhead.customHeight" type="number"
                           class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>
            <div>
                <label for="orientation" class="block text-sm font-medium text-gray-700">Orientação</label>
                <select v-model="letterhead.orientation"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>portrait</option>
                    <option>landscape</option>
                </select>
            </div>
        </div>
    </div>

    <div v-if="showEditor" class="modal z-20">
        <div class="modal-content">
            <h2>Editar {{ editingSection }}</h2>
            <label>Texto:</label>
            <Tiptap v-model="tipTapContent"/>
            <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto"
                        @click="saveEdits">
                    Salvar
                </button>
                <button type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                        @click="closeEditor"
                >
                    Cancelar
                </button>
            </div>
        </div>
    </div>

</template>

<script>
import Tiptap from '../components/Tiptap.vue'
import useLetterhead from "@/composables/letterhead.js";

export default {
    props: {
        letterhead: {
            type: Object,
            required: true
        }
    },
    components: {
        Tiptap
    },
    setup(props) {
        const {
            letterhead,
            pageStyle,
            pageWidth,
            pageHeight,
            scaledFontSize,
            startDrag,
            openHeaderEditor,
            openFooterEditor,
            onImageChange,
            saveEdits,
            closeEditor,
            showEditor,
            editingSection,
            editingText,
            editingImage,
            headerText,
            footerText,
            headerImage,
            footerImage,
            tipTapContent
        } = useLetterhead(props.letterhead);

        return {
            letterhead,
            pageStyle,
            pageWidth,
            pageHeight,
            scaledFontSize,
            startDrag,
            openHeaderEditor,
            openFooterEditor,
            onImageChange,
            saveEdits,
            closeEditor,
            showEditor,
            editingSection,
            editingText,
            editingImage,
            headerText,
            footerText,
            headerImage,
            footerImage,
            tipTapContent
        }
    }
}
</script>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f6f7f9c2;
}

.page {
    position: relative;
    width: 210mm;
    height: 297mm;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.margin.horizontal {
    position: absolute;
    border: 1px dashed #2563eb;
    cursor: ns-resize;
    width: 110%;
    height: 1px;
    left: -5%;
    z-index: 10;
}

.margin.vertical {
    position: absolute;
    border: 1px dashed #2563eb;
    cursor: ew-resize;
    height: 106%;
    width: 1px;
    top: -3%;
    z-index: 10;
}

.element.height {
    position: absolute;
    border: 1px dashed #1b6200;
    cursor: ns-resize;
    height: 1px;
    z-index: 5;
}

.distance-label {
    position: absolute;
    background-color: #333;
    color: white;
    padding: 2px 5px;
    font-size: 12px;
    border-radius: 3px;
    margin-left: 10px;
    min-width: 50px;
    max-width: 60px;
    text-align: center;
}

.page-config {
    display: flex;
    gap: 50px;
    margin-bottom: 20px;
}

.toggle-checkbox:checked {
    transform: translateX(100%);
    border-color: #4F46E5;
    transition: transform 0.2s ease-in-out, border-color 0.2s ease-in-out;
}

.toggle-checkbox {
    transition: transform 0.2s ease-in-out, border-color 0.2s ease-in-out;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 80vw;
    height: 80vh;
    display: flex;
    flex-direction: column;
    gap: 10px;
    overflow: auto;
}

.header-content, .footer-content {
    position: absolute;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px dashed #1b6200;
}
</style>
