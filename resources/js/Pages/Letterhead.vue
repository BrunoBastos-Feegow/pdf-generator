<template>
    <!--resources/js/Pages/Letterhead.vue-->
    <div class="container page-config">
        <div class="page" ref="page" :style="pageStyle">
            <div id="top-margin-line" class="margin horizontal"
                 :style="{top: `${letterhead.mTop}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('top', $event)">
                <span class="distance-label">{{ letterhead.mTop }} mm</span>
            </div>
            <div id="bottom-margin-line" class="margin horizontal"
                 :style="{bottom: `${letterhead.mBottom}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('bottom', $event)">
                <span class="distance-label">{{ letterhead.mBottom }} mm</span>
            </div>
            <div id="left-margin-line" class="margin vertical"
                 :style="{left: `${letterhead.mLeft}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('left', $event)">
                <span class="distance-label">{{ letterhead.mLeft }} mm</span>
            </div>
            <div id="right-margin-line" class="margin vertical"
                 :style="{right: `${letterhead.mRight}px`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('right', $event)">
                <span class="distance-label">{{ letterhead.mRight }} mm</span>
            </div>

            <div v-if="letterhead.useHeader" id="header-height-line" class="element height"
                 :style="{top: `${letterhead.mTop + letterhead.headerHeight}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}"
                 style="display: flex; justify-content: center; align-items: center;"
                 @mousedown="startDrag('header', $event)">
                <span class="distance-label">{{ letterhead.headerHeight }} mm</span>
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
                <span class="distance-label">{{ letterhead.footerHeight }} mm</span>
            </div>
            <div v-if="letterhead.useFooter" class="footer-content border-2 border-dashed border-gray-300"
                 :style="{fontSize: `${scaledFontSize}px`, height: `${letterhead.footerHeight}px`, bottom: `${letterhead.mBottom}px`, left: `${letterhead.mLeft}px`, right: `${letterhead.mRight}px`, width: `calc(100% - ${letterhead.mLeft}px - ${letterhead.mRight}px)`}">
                <span v-if="!footerText && !footerImage" @click="openFooterEditor">Clique para editar o rodapé</span>
                <span v-else @click="openFooterEditor" v-html="footerText"></span>
                <img v-if="footerImage" :src="footerImage" alt="Imagem do Rodapé"/>
            </div>
        </div>

        <div class="config-panel flex flex-col space-y-4 mr-6">
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
            <Tiptap v-model="content"/>
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
import axios from 'axios';

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
    data() {
        return {
            SCALE_FACTOR: 4,
            ZOOM_FACTOR: 0.5,
            dragging: null,
            startY: 0,
            startX: 0,
            showEditor: false,
            editingSection: '',
            editingText: '',
            editingImage: null,
            content: '',

            //usar para compor o Cabecalho e Rodape
            headerText: '',
            footerText: '',
            headerImage: null,
            footerImage: null,
            preventSave: false,
        };
    },
    watch: {
        letterhead: {
            handler() {
                if (!this.preventSave) {
                    this.saveConfigs();
                }
            },
            deep: true
        }
    },
    computed: {
        pageStyle() {
            const width = this.letterhead.orientation === 'portrait' ? this.pageWidth : this.pageHeight;
            const height = this.letterhead.orientation === 'portrait' ? this.pageHeight : this.pageWidth;
            return {
                width: `${width * this.SCALE_FACTOR * this.ZOOM_FACTOR}px`,
                height: `${height * this.SCALE_FACTOR * this.ZOOM_FACTOR}px`
            };
        },
        pageWidth() {
            switch (this.letterhead.paperSize) {
                case 'A4':
                    return 210;
                case 'Letter':
                    return 215.9;
                case 'A3':
                    return 297;
                case 'A5':
                    return 148;
                case 'A6':
                    return 105;
                case 'custom':
                    return this.letterhead.customWidth;
                default:
                    return 210;
            }
        },
        pageHeight() {
            switch (this.letterhead.paperSize) {
                case 'A4':
                    return 297;
                case 'Letter':
                    return 279.4;
                case 'A3':
                    return 420;
                case 'A5':
                    return 210;
                case 'A6':
                    return 148;
                case 'custom':
                    return this.letterhead.customHeight;
                default:
                    return 297;
            }
        },
        scaledFontSize() {
            const baseFontSize = 12;
            return baseFontSize * this.ZOOM_FACTOR;
        }
    },
    mounted() {
        console.warn("letterhead", this.letterhead)
    },
    methods: {
        startDrag(direction, event) {
            this.preventSave = true;
            this.dragging = direction;
            if (direction === 'top' || direction === 'bottom' || direction === 'header' || direction === 'footer') {
                this.startY = event.clientY;
            } else {
                this.startX = event.clientX;
            }
            window.addEventListener('mousemove', this.drag);
            window.addEventListener('mouseup', this.stopDrag);
        },
        drag(event) {
            const PAGE_HEIGHT = 877;
            const PAGE_WIDTH = 620;
            const MIN_MARGIN = 0;
            const MIN_GAP = 100;
            const MAX_HEADER_HEIGHT = PAGE_HEIGHT - this.letterhead.mTop - this.letterhead.mBottom - MIN_GAP;
            const MAX_FOOTER_HEIGHT = PAGE_HEIGHT - this.letterhead.mTop - this.letterhead.mBottom - MIN_GAP;

            if (this.dragging === 'top') {
                const delta = event.clientY - this.startY;
                this.letterhead.mTop = Math.min(PAGE_HEIGHT - this.letterhead.mBottom - MIN_GAP, Math.max(MIN_MARGIN, this.letterhead.mTop + delta));
                this.startY = event.clientY
            } else if (this.dragging === 'bottom') {
                const delta = event.clientY - this.startY;
                this.letterhead.mBottom = Math.min(PAGE_HEIGHT - this.letterhead.mTop - MIN_GAP, Math.max(MIN_MARGIN, this.letterhead.mBottom - delta));
                this.startY = event.clientY;
            } else if (this.dragging === 'left') {
                const delta = event.clientX - this.startX;
                this.letterhead.mLeft = Math.min(PAGE_WIDTH - this.letterhead.mRight - MIN_GAP, Math.max(MIN_MARGIN, this.letterhead.mLeft + delta));
                this.startX = event.clientX;
            } else if (this.dragging === 'right') {
                const delta = event.clientX - this.startX;
                this.letterhead.mRight = Math.min(PAGE_WIDTH - this.letterhead.mLeft - MIN_GAP, Math.max(MIN_MARGIN, this.letterhead.mRight - delta));
                this.startX = event.clientX;
            } else if (this.dragging === 'header') {
                const delta = event.clientY - this.startY;
                this.letterhead.headerHeight = Math.min(MAX_HEADER_HEIGHT, Math.max(MIN_MARGIN, this.letterhead.headerHeight + delta));
                this.startY = event.clientY;
            } else if (this.dragging === 'footer') {
                const delta = event.clientY - this.startY;
                this.letterhead.footerHeight = Math.min(MAX_FOOTER_HEIGHT, Math.max(MIN_MARGIN, this.letterhead.footerHeight - delta));
                this.startY = event.clientY;
            }
        },
        stopDrag() {
            this.dragging = null;
            window.removeEventListener('mousemove', this.drag);
            window.removeEventListener('mouseup', this.stopDrag);
            this.preventSave = false;
            this.saveConfigs();
        },
        saveConfigs() {
            axios.post(route('letterhead.save'), this.letterhead)
                .then(response => {
                    console.log('Configurações salvas com sucesso.');
                })
                .catch(error => {
                    console.error('Erro ao salvar as configurações:', error);
                });
        },
        openHeaderEditor() {
            this.editingSection = 'Cabeçalho';
            this.editingText = this.headerText;
            this.editingImage = this.headerImage;
            this.content = this.headerText;
            this.showEditor = true;
        },
        openFooterEditor() {
            this.editingSection = 'Rodapé';
            this.editingText = this.footerText;
            this.editingImage = this.footerImage;
            this.content = this.footerText;
            this.showEditor = true;
        },
        onImageChange(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.editingImage = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        saveEdits() {
            if (this.editingSection === 'Cabeçalho') {
                this.headerText = this.content;
                this.headerImage = this.editingImage;
            } else {
                this.footerText = this.content;
                this.footerImage = this.editingImage;

            }
            this.closeEditor();
        },
        closeEditor() {
            this.showEditor = false;
            this.editingText = '';
            this.editingImage = null;
            this.content = '';
        }
    }
};
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


