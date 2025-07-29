<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sistema de Descontos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3>Produtos</h3>
                    <ul>
                        @foreach ($produtos as $produto)
                            <li>{{ $produto->product_name }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</li>
                        @endforeach
                    </ul>

                    <form method="POST" action="{{ route('aplicar-cupom') }}">
                        @csrf
                        <label for="codigo_cupom">Código do Cupom:</label>
                        <br>
                        <input
                            type="text"
                            name="codigo_cupom"
                            id="codigo_cupom"
                            value="{{ session('cupom_codigo') ?? old('codigo_cupom') }}"
                            required
                        >
                        <br>
                        <button type="submit" style="background-color: #000000; color: white; border: none; padding: 5px 10px; cursor: pointer;">Aplicar Cupom</button>
                    </form>

                    @if(session('cupom_aplicado'))
                        <p>Desconto aplicado: R$ {{ number_format(session('desconto'), 2, ',', '.') }}</p>
                        <p>Total com desconto: R$ {{ number_format(session('total_com_desconto'), 2, ',', '.') }}</p>

                        <form method="POST" action="{{ route('remover-cupom') }}" style="margin-top: 10px;">
                            @csrf
                            <button type="submit" style="background-color: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Remover Desconto
                            </button>
                        </form>
                    @endif

                    @if($errors->any())
                        <div style="color: red; margin-top: 10px;">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
