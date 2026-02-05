<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h4 class="mb-4">
                    <i class="bi bi-building me-2"></i>
                    Instituto 30 de Setembro
                </h4>
                <p>Formando técnicos profissionais de excelência desde 2000. Comprometidos com a educação de qualidade e
                    o desenvolvimento de Angola.</p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 mb-4">
                <h5 class="mb-4">Links Rápidos</h5>
                <div class="footer-links">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('sobre') }}">Sobre Nós</a>
                    <a href="{{ route('contacto') }}">Contacto</a>
                    <a href="{{ route('login') }}">Área Restrita</a>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 mb-4">
                <h5 class="mb-4">Contactos</h5>
                <p class="mb-2">
                    <i class="bi bi-geo-alt me-2"></i>
                    Luanda, Angola
                </p>
                <p class="mb-2">
                    <i class="bi bi-telephone me-2"></i>
                    +244 222 123 456
                </p>
                <p class="mb-2">
                    <i class="bi bi-envelope me-2"></i>
                    info@ip30setembro.edu.ao
                </p>
            </div>

            <div class="col-lg-3 col-md-4 mb-4">
                <h5 class="mb-4">Horário</h5>
                <p class="mb-2">Segunda - Sexta: 8h00 - 18h00</p>
                <p>Sábado: 8h00 - 12h00</p>
            </div>
        </div>

        <hr class="bg-light my-4">

        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; {{ date('Y') }} Instituto Politécnico 30 de Setembro. Todos os direitos
                    reservados.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0">
                    <a href="#" class="text-white me-3">Política de Privacidade</a>
                    <a href="#" class="text-white">Termos de Uso</a>
                </p>
            </div>
        </div>
    </div>
</footer>
