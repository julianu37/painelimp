            
            
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Imagens Associadas</h3>
                        
                         <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    <?php if($codigo->imagens->isNotEmpty()): ?>
                       <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                            <?php $__currentLoopData = $codigo->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group">
                                    <img src="<?php echo e(Storage::url($imagem->path)); ?>" alt="<?php echo e($imagem->titulo); ?>" class="w-full h-32 object-cover rounded-md shadow-md">
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300 rounded-md">
                                        <a href="<?php echo e(route('admin.imagens.edit', $imagem)); ?>" class="text-white text-xs bg-indigo-600 px-2 py-1 rounded mr-1">Editar</a>
                                        <form action="<?php echo e(route('admin.imagens.destroy', $imagem)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Excluir imagem?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-white text-xs bg-red-600 px-2 py-1 rounded">X</button>
                                        </form>
                                    </div>
                                     <p class="text-xs text-center mt-1 truncate" title="<?php echo e($imagem->titulo); ?>"><?php echo e($imagem->titulo); ?></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma imagem associada a este código de erro.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Vídeos Associados</h3>
                         
                          <span class="text-xs text-gray-500">(Funcionalidade Adicionar Pendente)</span>
                    </div>
                    <?php if($codigo->videos->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                             <?php $__currentLoopData = $codigo->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-3 flex justify-between items-center">
                                   <span>
                                        <?php echo e($video->titulo ?? ($video->tipo === 'link' ? $video->url_ou_path : 'Arquivo de Vídeo')); ?>

                                        <span class="text-xs text-gray-500">(<?php echo e(Str::ucfirst($video->tipo)); ?>)</span>
                                        <?php if($video->tipo === 'link'): ?>
                                            <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="text-blue-500 hover:underline ml-1 text-xs">(abrir)</a>
                                        <?php endif; ?>
                                    </span>
                                    <div>
                                        <a href="<?php echo e(route('admin.videos.edit', $video)); ?>" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">Editar</a>
                                         <form action="<?php echo e(route('admin.videos.destroy', $video)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Excluir vídeo?');">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 text-xs">Excluir</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                         <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum vídeo associado a este código de erro.</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Comentários Técnicos</h3>

                    
                    <form action="<?php echo e(route('comentarios.store', ['comentavel_type' => 'codigo_erro', 'comentavel_id' => $codigo->id])); ?>" method="POST" enctype="multipart/form-data" class="mb-6 p-4 border rounded-md dark:border-gray-700">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label for="conteudo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adicionar Comentário:</label>
                            <textarea name="conteudo" id="conteudo" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required><?php echo e(old('conteudo')); ?></textarea>
                             <?php $__errorArgs = ['conteudo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="midias" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Anexar Arquivos (JPG, PNG, GIF, PDF, MP4 - Máx 10MB cada):</label>
                                <input type="file" name="midias[]" id="midias" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600">
                                <?php $__errorArgs = ['midias.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php $__errorArgs = ['midias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                     <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ou Link do YouTube:</label>
                                <input type="url" name="youtube_link" id="youtube_link" placeholder="https://www.youtube.com/watch?v=..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" value="<?php echo e(old('youtube_link')); ?>">
                                <?php $__errorArgs = ['youtube_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-red-600 mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Salvar Comentário
                            </button>
                        </div>
                    </form>

                    
                    <div class="space-y-6">
                        <?php $__empty_1 = true; $__currentLoopData = $codigo->comentarios->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comentario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                            <div class="p-4 border rounded-md dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="font-semibold text-sm text-gray-800 dark:text-gray-200"><?php echo e($comentario->user->name ?? 'Usuário desconhecido'); ?></span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400" title="<?php echo e($comentario->created_at->format('d/m/Y H:i:s')); ?>"><?php echo e($comentario->created_at->diffForHumans()); ?></span>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 mb-3 whitespace-pre-wrap"><?php echo e($comentario->conteudo); ?></p>

                                
                                <?php if($comentario->midias->isNotEmpty()): ?>
                                    <div class="mt-3 border-t pt-3 dark:border-gray-600">
                                        <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Anexos:</p>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            <?php $__currentLoopData = $comentario->midias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <?php if($midia->is_imagem): ?>
                                                        <a href="<?php echo e($midia->url); ?>" target="_blank" title="<?php echo e($midia->nome_original ?? 'Ver imagem'); ?>">
                                                            <img src="<?php echo e($midia->url); ?>" alt="<?php echo e($midia->nome_original ?? 'Imagem anexa'); ?>" class="max-h-40 w-auto rounded-md shadow-sm mb-1 object-contain border dark:border-gray-700">
                                                        </a>
                                                    <?php elseif($midia->is_video_mp4): ?>
                                                        <video controls class="max-h-40 w-auto rounded-md shadow-sm mb-1 border dark:border-gray-700 bg-black">
                                                            <source src="<?php echo e($midia->url); ?>" type="video/mp4">
                                                            Seu navegador não suporta o vídeo MP4.
                                                        </video>
                                                    <?php elseif($midia->is_video_youtube): ?>
                                                        <div class="aspect-w-16 aspect-h-9 mb-1">
                                                             <iframe src="<?php echo e($midia->url); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen class="rounded-md shadow-sm border dark:border-gray-700"></iframe>
                                                        </div>
                                                    <?php elseif($midia->is_pdf): ?>
                                                        <a href="<?php echo e($midia->url); ?>" target="_blank" class="inline-flex items-center text-sm text-blue-600 hover:underline dark:text-blue-400">
                                                            
                                                            <svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 0a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.5A1.5 1.5 0 0 0 16.5 5h-5A1.5 1.5 0 0 1 10 .5V0H4zm8 6v4h4V6h-4zm-2 8H6v-2h4v2zm4 0h-2v-2h2v2zm0-3H6V9h8v2z"/></svg>
                                                            <?php echo e($midia->nome_original ?? 'Abrir PDF'); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                     <p class="text-xs text-gray-500 truncate" title="<?php echo e($midia->nome_original); ?>"><?php echo e($midia->nome_original); ?></p>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                
                                <div class="mt-3 border-t pt-2 dark:border-gray-600 flex justify-between items-center">
                                    
                                    <div class="flex items-center space-x-4">
                                        <?php if(auth()->guard()->check()): ?> 
                                            <?php if($comentario->isLikedByAuthUser()): ?>
                                                
                                                <form action="<?php echo e(route('comments.unlike', $comentario)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-500 hover:text-red-800 dark:hover:text-red-400" title="Remover Curtida">
                                                        <svg class="w-4 h-4 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                                        </svg>
                                                        Descurtir
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                
                                                <form action="<?php echo e(route('comments.like', $comentario)); ?>" method="POST" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="flex items-center text-xs text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-500" title="Curtir Comentário">
                                                        <svg class="w-4 h-4 mr-1 fill-none stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                                        </svg>
                                                        Curtir
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        
                                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">
                                            (<?php echo e($comentario->likers_count ?? 0); ?> curtida<?php echo e(($comentario->likers_count ?? 0) != 1 ? 's' : ''); ?>)
                                        </span>
                                    </div>
                                    
                                    <span class="text-gray-300 dark:text-gray-600">|</span>

                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $comentario)): ?>
                                        <a href="<?php echo e(route('comentarios.edit', $comentario)); ?>" class="flex items-center text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300" title="Editar Comentário">
                                            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                            Editar
                                        </a>
                                    <?php endif; ?>
                                </div>

                                
                                <div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $comentario)): ?>
                                        <form action="<?php echo e(route('comentarios.destroy', $comentario)); ?>" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este comentário?');" class="inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="flex items-center text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" title="Excluir Comentário">
                                                <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                Excluir
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nenhum comentário adicionado ainda.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            

              

            
            <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Soluções Associadas</h3>
                    <?php if($codigo->solucoes->isNotEmpty()): ?>
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            
                            <?php $__currentLoopData = $codigo->solucoes->load('imagens', 'videos'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solucao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 dark:text-gray-200"><?php echo e($solucao->titulo); ?></p>
                                            <?php if($solucao->descricao): ?>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap mt-1"><?php echo e($solucao->descricao); ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4 flex-shrink-0 space-x-2">
                                            <a href="<?php echo e(route('admin.solucoes.edit', $solucao)); ?>" class="text-sm text-indigo-600 hover:underline">Editar</a>
                                            <form action="<?php echo e(route('admin.solucoes.destroy', $solucao)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir esta solução e todas as suas mídias?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="text-sm text-red-600 hover:underline">Excluir</button>
                                            </form>
                                        </div>
                                    </div>

                                    
                                    <?php if($solucao->imagens->isNotEmpty() || $solucao->videos->isNotEmpty()): ?>
                                        <div class="mt-3 border-t pt-3 dark:border-gray-600">
                                            <p class="text-xs font-medium text-gray-600 dark:text-gray-400 mb-2">Mídias da Solução:</p>

                                             
                                            <?php if($solucao->imagens->isNotEmpty()): ?>
                                                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 mb-3">
                                                    <?php $__currentLoopData = $solucao->imagens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <a href="<?php echo e($imagem->url); ?>" target="_blank" title="<?php echo e($imagem->titulo ?? $imagem->nome_original); ?>" class="block relative">
                                                            <img src="<?php echo e($imagem->url); ?>" alt="<?php echo e($imagem->titulo ?? 'Imagem anexa'); ?>" class="w-full h-16 object-cover rounded shadow-sm border dark:border-gray-700">
                                                            <p class="text-[10px] text-center mt-0.5 truncate text-gray-500 dark:text-gray-400" title="<?php echo e($imagem->titulo ?? $imagem->nome_original); ?>"><?php echo e($imagem->titulo ?? $imagem->nome_original); ?></p>
                                                        </a>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                            
                                            <?php if($solucao->videos->isNotEmpty()): ?>
                                                <div class="space-y-2">
                                                    <?php $__currentLoopData = $solucao->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <?php if($video->tipo === 'link'): ?>
                                                                <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:underline dark:text-blue-400">
                                                                     <svg class="w-3 h-3 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                                    <?php echo e($video->titulo ?? $video->url_ou_path); ?>

                                                                </a> (Link YouTube)
                                                            <?php else: ?>
                                                                <a href="<?php echo e($video->url_ou_path); ?>" target="_blank" class="inline-flex items-center text-xs text-blue-600 hover:underline dark:text-blue-400">
                                                                    <svg class="w-3 h-3 mr-1 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.022 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
                                                                    <?php echo e($video->titulo ?? $video->nome_original); ?>

                                                                </a> (Upload)
                                                                 
                                                                
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nenhuma solução associada a este código de erro.</p>
                    <?php endif; ?>
                </div>
            </div>
             <?php /**PATH C:\painelimp\resources\views\admin\codigos_erro\show.blade.php ENDPATH**/ ?>