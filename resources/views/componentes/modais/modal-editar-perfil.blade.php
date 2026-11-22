{{-- 
    Modal: Editar Perfil e Dados Cadastrais (RF011 / Perfil)
    Responsável Acadêmica: Maria Eduarda (Duda)
    Permite editar Nome, E-mail, Telefone, Chave Pix, Banco Principal e Foto/Avatar.
--}}
<div id="modalEditarPerfil" class="hidden fixed inset-0 z-[9999] flex items-end sm:items-center justify-center p-0 sm:p-4" role="dialog" aria-modal="true">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-xs" onclick="fecharModalId('modalEditarPerfil')"></div>

    <div class="relative w-full sm:max-w-lg bg-card rounded-t-3xl sm:rounded-3xl shadow-elevated flex flex-col overflow-hidden max-h-[92vh] transition-all" style="animation: slideUp 0.25s cubic-bezier(0.16, 1, 0.3, 1)">
        <!-- Header -->
        <div class="px-6 pt-4 pb-3 border-b border-border/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="size-9 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-800 dark:text-emerald-300 flex items-center justify-center border border-emerald-500/20">
                    <i data-lucide="user-cog" class="size-5"></i>
                </span>
                <div>
                    <h3 class="text-base font-extrabold text-foreground">Editar Dados do Perfil</h3>
                    <p class="text-xs text-muted-foreground">Atualize seus dados pessoais e de contato</p>
                </div>
            </div>
            <button type="button" onclick="fecharModalId('modalEditarPerfil')" class="size-8 rounded-xl border border-border bg-muted/40 hover:bg-muted text-muted-foreground hover:text-foreground flex items-center justify-center transition">
                <i data-lucide="x" class="size-4"></i>
            </button>
        </div>

        <form onsubmit="executarSalvarPerfil(event)" class="p-6 space-y-4 overflow-y-auto no-scrollbar">
            <!-- Escolha de Avatar / Foto -->
            <div class="space-y-2">
                <label class="text-xs font-bold text-foreground block">Foto / Avatar de Identificação</label>
                <div class="flex items-center gap-4">
                    <div id="previewAvatarPerfil" class="size-16 rounded-full bg-emerald-800 text-white font-black text-xl flex items-center justify-center ring-4 ring-emerald-500/20 shrink-0 shadow-2xs overflow-hidden">
                        <img id="previewAvatarImgTag" src="" alt="Foto" class="hidden size-full object-cover">
                        <span id="previewAvatarIniciais">ME</span>
                    </div>
                    <div class="flex-1 space-y-2">
                        <input type="hidden" id="formPerfilAvatar" value="">
                        <input type="file" id="inputFotoPerfilUpload" accept="image/*" class="hidden" onchange="lidarArquivoFotoPerfil(this)">
                        
                        <div class="flex flex-wrap items-center gap-2">
                            <button type="button" onclick="document.getElementById('inputFotoPerfilUpload').click()" 
                                    class="px-3 py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold flex items-center gap-1.5 shadow-xs transition cursor-pointer">
                                <i data-lucide="upload" class="size-3.5"></i>
                                <span>Escolher foto do dispositivo</span>
                            </button>
                            <button type="button" onclick="removerFotoPerfil()" 
                                    class="px-3 py-2 rounded-xl border border-border bg-card hover:bg-muted text-muted-foreground hover:text-foreground text-xs font-semibold shadow-2xs transition cursor-pointer">
                                Usar Iniciais
                            </button>
                        </div>

                        <!-- Dropzone e URL de foto -->
                        <div id="dropzoneFotoPerfil" 
                             ondragover="event.preventDefault(); this.classList.add('border-emerald-600', 'bg-emerald-50/20');"
                             ondragleave="event.preventDefault(); this.classList.remove('border-emerald-600', 'bg-emerald-50/20');"
                             ondrop="lidarDropFotoPerfil(event)"
                             class="border border-dashed border-border rounded-xl p-2 text-center text-[10px] text-muted-foreground transition cursor-pointer hover:border-emerald-600/60"
                             onclick="document.getElementById('inputFotoPerfilUpload').click()">
                            <span>Ou arraste e solte uma imagem aqui (JPG ou PNG)</span>
                        </div>

                        <input type="url" id="formPerfilAvatarUrl" placeholder="Ou cole a URL direta de uma foto..." oninput="selecionarAvatarPerfil(this.value)"
                               class="w-full text-[11px] rounded-xl border border-border bg-background px-3 py-1.5 text-foreground placeholder:text-muted-foreground focus:outline-none focus:ring-1 focus:ring-emerald-600">
                    </div>
                </div>
            </div>

            <!-- Nome Completo -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold text-foreground">Nome Completo</label>
                <input type="text" id="formPerfilNome" required 
                       class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs">
            </div>

            <!-- E-mail e Telefone -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">E-mail</label>
                    <input type="email" id="formPerfilEmail" required 
                           class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Telefone / WhatsApp</label>
                    <input type="tel" id="formPerfilTelefone" placeholder="(11) 98765-4321" 
                           class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs">
                </div>
            </div>

            <!-- Chave Pix e Banco Principal (Essencial para o Cobrador Diplomata) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Sua Chave PIX</label>
                    <input type="text" id="formPerfilChavePix" placeholder="E-mail, CPF ou celular" 
                           class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground placeholder:text-muted-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs">
                </div>

                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-foreground">Banco Principal</label>
                    <select id="formPerfilBancoPrincipal" 
                            class="w-full rounded-2xl border border-border bg-background px-4 py-3 text-xs text-foreground focus:border-emerald-600 focus:outline-none focus:ring-1 focus:ring-emerald-600 shadow-2xs">
                        <option value="Nubank">Nubank</option>
                        <option value="Inter">Banco Inter</option>
                        <option value="Itaú">Itaú</option>
                        <option value="Bradesco">Bradesco</option>
                        <option value="Santander">Santander</option>
                        <option value="Caixa">Caixa Econômica</option>
                        <option value="Banco do Brasil">Banco do Brasil</option>
                        <option value="C6 Bank">C6 Bank</option>
                        <option value="Outro">Outro banco</option>
                    </select>
                </div>
            </div>

            <div class="pt-2 flex gap-2">
                <button type="submit" class="flex-1 py-3.5 rounded-2xl bg-emerald-800 hover:bg-emerald-900 text-white font-extrabold text-xs shadow-soft transition cursor-pointer flex items-center justify-center gap-1.5">
                    <i data-lucide="check" class="size-4"></i>
                    <span>Salvar Alterações</span>
                </button>
                <button type="button" onclick="fecharModalId('modalEditarPerfil')" class="py-3.5 px-4 rounded-2xl border border-border bg-card hover:bg-muted text-foreground font-bold text-xs shadow-2xs transition">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
