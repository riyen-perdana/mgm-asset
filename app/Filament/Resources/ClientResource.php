<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-m-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Select::make('client_jns')
                            ->label('Jenis Pengguna')
                            ->options([
                                'mahasiswa' => 'Mahasiswa',
                                'pegawai' => 'Tendik/Dosen',
                                'ormawa' => 'Organisasi Mahasiswa',
                                'umum' => 'Umum',
                                'universitas' => 'Universitas',
                            ])
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Pengguna Harus Dipilih',
                            ])
                            ->placeholder('Jenis Pengguna'),

                        TextInput::make('client_id')
                            ->label('Tanda Pengenal')
                            ->required()
                            ->unique('client', 'client_id',ignoreRecord: true)
                            ->validationMessages([
                                'required' => 'Kolom Tanda Pengenal Harus Diisi',
                            ])
                            ->placeholder('Isikan NIM, NIP, NIK atau KTP'),

                        TextInput::make('client_nm')
                            ->label('Nama Pengguna')
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Nama Pengguna Harus Diisi',
                            ])
                            ->placeholder('Nama Pengguna'),

                        Select::make('client_jk')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-Laki',
                                'P' => 'Perempuan',
                            ])
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Kelamin Harus Dipilih',
                            ])
                            ->placeholder('Jenis Pengguna'),

                        TextInput::make('client_alamat')
                            ->label('Alamat')
                            ->required()
                            ->columnSpan(2)
                            ->validationMessages([
                                'required' => 'Kolom Alamat Harus Diisi',
                            ])
                            ->placeholder('Alamat'),

                        TextInput::make('client_email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Email Harus Diisi',
                                'email' => 'Kolom Email Tidak Valid, Ulangi',
                            ])
                            ->placeholder('Email'),

                        TextInput::make('client_telp')
                            ->label('Nomor Telepon')
                            ->tel()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Nomor Telepon Harus Diisi',
                                'tel' => 'Kolom Nomor Telepon Tidak Valid, Ulangi',
                            ])
                            ->placeholder('Nomor Telepon'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client_jns')->label('Jenis Pengguna')->searchable(),
                TextColumn::make('client_id')->label('Tanda Pengenal')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            // 'create' => Pages\CreateClient::route('/create'),
            // 'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
