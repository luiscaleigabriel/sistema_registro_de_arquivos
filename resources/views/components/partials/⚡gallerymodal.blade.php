<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <!-- Modal de Galeria -->
    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Galeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="https://via.placeholder.com/800x600/1e3a8a/ffffff?text=Imagem+da+Galeria"
                        class="img-fluid rounded" alt="Imagem Galeria">
                    <p class="mt-3">Descrição da imagem...</p>
                </div>
            </div>
        </div>
    </div>
</div>
