// Path: resources/js/composables/letterhead.js
import {ref, watch, computed} from "vue";
import axios from "axios";
import _ from "lodash";

export default function useLetterhead(letterhead) {
    const SCALE_FACTOR = 4;
    const ZOOM_FACTOR = 0.5;
    const dragging = ref(null);
    const startY = ref(0);
    const startX = ref(0);
    const showEditor = ref(false);
    const editingSection = ref('');
    const editingText = ref('');
    const editingImage = ref(null);
    const tipTapContent = ref('');
    const headerText = ref('');
    const footerText = ref('');
    const headerImage = ref(null);
    const footerImage = ref(null);

    const pageStyle = computed(() => {
        const width = letterhead.orientation === 'portrait' ? pageWidth.value : pageHeight.value;
        const height = letterhead.orientation === 'portrait' ? pageHeight.value : pageWidth.value;
        return {
            width: `${width * SCALE_FACTOR * ZOOM_FACTOR}px`,
            height: `${height * SCALE_FACTOR * ZOOM_FACTOR}px`
        };
    });

    const pageWidth = computed(() => {
        switch (letterhead.paperSize) {
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
                return letterhead.customWidth;
            default:
                return 210;
        }
    });

    const pageHeight = computed(() => {
        switch (letterhead.paperSize) {
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
                return letterhead.customHeight;
            default:
                return 297;
        }
    });

    const scaledFontSize = computed(() => {
        const baseFontSize = 12;
        return baseFontSize * ZOOM_FACTOR;
    });

    const startDrag = (direction, event) => {
        dragging.value = direction;
        if (direction === 'top' || direction === 'bottom' || direction === 'header' || direction === 'footer') {
            startY.value = event.clientY;
        } else {
            startX.value = event.clientX;
        }
        window.addEventListener('mousemove', drag);
        window.addEventListener('mouseup', stopDrag);
    };

    const drag = (event) => {
        const PAGE_HEIGHT = 877;
        const PAGE_WIDTH = 620;
        const MIN_MARGIN = 0;
        const MIN_GAP = 100;
        const MAX_HEADER_HEIGHT = PAGE_HEIGHT - letterhead.mTop - letterhead.mBottom - MIN_GAP;
        const MAX_FOOTER_HEIGHT = PAGE_HEIGHT - letterhead.mTop - letterhead.mBottom - MIN_GAP;

        if (dragging.value === 'top') {
            const delta = event.clientY - startY.value;
            letterhead.mTop = Math.min(PAGE_HEIGHT - letterhead.mBottom - MIN_GAP, Math.max(MIN_MARGIN, letterhead.mTop + delta));
            startY.value = event.clientY
        } else if (dragging.value === 'bottom') {
            const delta = event.clientY - startY.value;
            letterhead.mBottom = Math.min(PAGE_HEIGHT - letterhead.mTop - MIN_GAP, Math.max(MIN_MARGIN, letterhead.mBottom - delta));
            startY.value = event.clientY;
        } else if (dragging.value === 'left') {
            const delta = event.clientX - startX.value;
            letterhead.mLeft = Math.min(PAGE_WIDTH - letterhead.mRight - MIN_GAP, Math.max(MIN_MARGIN, letterhead.mLeft + delta));
            startX.value = event.clientX;
        } else if (dragging.value === 'right') {
            const delta = event.clientX - startX.value;
            letterhead.mRight = Math.min(PAGE_WIDTH - letterhead.mLeft - MIN_GAP, Math.max(MIN_MARGIN, letterhead.mRight - delta));
            startX.value = event.clientX;
        } else if (dragging.value === 'header') {
            const delta = event.clientY - startY.value;
            letterhead.headerHeight = Math.min(MAX_HEADER_HEIGHT, Math.max(MIN_MARGIN, letterhead.headerHeight + delta));
            startY.value = event.clientY;
        } else if (dragging.value === 'footer') {
            const delta = event.clientY - startY.value;
            letterhead.footerHeight = Math.min(MAX_FOOTER_HEIGHT, Math.max(MIN_MARGIN, letterhead.footerHeight - delta));
            startY.value = event.clientY;
        }
    };

    const stopDrag = () => {
        dragging.value = null;
        window.removeEventListener('mousemove', drag);
        window.removeEventListener('mouseup', stopDrag);
        saveConfigs();
    };

    const saveConfigs = _.debounce(() => {
        axios.post(route('letterhead.save'), letterhead)
            .then(response => {
                console.log('Configurações salvas com sucesso.');
            })
            .catch(error => {
                console.error('Erro ao salvar as configurações:', error);
            });
    }, 500);

    const openHeaderEditor = () => {
        editingSection.value = 'Cabeçalho';
        editingText.value = headerText.value;
        editingImage.value = headerImage.value;
        tipTapContent.value = headerText.value;
        showEditor.value = true;
    };

    const openFooterEditor = () => {
        editingSection.value = 'Rodapé';
        editingText.value = footerText.value;
        editingImage.value = footerImage.value;
        tipTapContent.value = footerText.value;
        showEditor.value = true;
    };

    const onImageChange = (event) => {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            editingImage.value = e.target.result;
        };
        reader.readAsDataURL(file);
    };

    const saveEdits = () => {
        if (editingSection.value === 'Cabeçalho') {
            headerText.value = tipTapContent.value;
            headerImage.value = editingImage.value;
        } else {
            footerText.value = tipTapContent.value;
            footerImage.value = editingImage.value;
        }
        closeEditor();
    }

    const closeEditor = () => {
        showEditor.value = false;
        editingText.value = '';
        editingImage.value = null;
        tipTapContent.value = '';
    }

    watch(letterhead, () => {
        saveConfigs();
    }, {deep: true});

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
