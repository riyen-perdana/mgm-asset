<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
<<<<<<< HEAD
use Filament\Forms\Components\Textarea;
=======
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
<<<<<<< HEAD
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;
=======
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

<<<<<<< HEAD
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Relasi';

    protected static ?string $modelLabel = 'Relasi';

    protected static ?string $pluralModelLabel = 'Relasi';
=======
    protected static ?string $navigationIcon = 'heroicon-m-user-group';
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
<<<<<<< HEAD
                    // ->columns(2)
                    ->schema([
                        Select::make('client_jns')
                            ->label('Jenis Relasi')
                            ->options([
                                'mahasiswa' => 'Mahasiswa',
                                'tendik' => 'Tenaga Kependidikan',
                                'dosen' => 'Dosen',
                                'umum' => 'Umum',
                            ])
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Relasi Harus Diisi'
                            ]),
                        TextInput::make('client_id')
                            ->required()
                            ->label('NIM, NIP atau Nomor KTP/Passport')
                            ->unique('client', 'client_id', ignoreRecord: true)
                            ->validationMessages([
                                'unique' => 'NIM, NIP atau Nomor KTP sudah ada, Isikan yang Lain',
                                'required' => 'Kolom NIM, NIP atau Nomor KTP Harus Diisi'
                            ]),
                        TextInput::make('client_nm')
                            ->required()
                            ->label('Nama')
                            ->validationMessages([
                                'required' => 'Kolom Nama Harus Diisi'
                            ]),
=======
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

>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
                        Select::make('client_jk')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-Laki',
                                'P' => 'Perempuan',
                            ])
<<<<<<< HEAD
                            ->searchable()
                            ->required()
                            ->validationMessages([
                                'required' => 'Kolom Jenis Kelamin Harus Diisi'
                            ]),
                        Textarea::make('client_alamat')
                            ->required()
                            ->label('Alamat')
                            ->validationMessages([
                                'required' => 'Kolom Alamat Harus Diisi'
                            ])
                            ->columnSpan(2),
                        TextInput::make('client_email')
                            ->email()
                            ->required()
                            ->label('Email')
                            ->validationMessages([
                                'required' => 'Kolom Email Harus Diisi',
                                'email' => 'Kolom Email Tidak Valid'
                            ]),
                        TextInput::make('client_telp')
                            ->tel()
                            ->required()
                            ->label('Nomor Telepon')
                            ->validationMessages([
                                'required' => 'Kolom Nomor Telepon Harus Diisi',
                                'tel' => 'Kolom Nomor Telepon Tidak Valid'
                            ]),
                    ])
                    ->columns(2),
=======
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
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
<<<<<<< HEAD
                Tables\Columns\TextColumn::make('index')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            )).'.'
                        );
                    }
                )
                ->label('No.')
                ->width('3%'),
                Tables\Columns\TextColumn::make('client_id')
                    ->label('No. Pengenal')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_nm')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_jk')
                    ->label('Jenis Kelamin')
                    ->searchable()
                    ->width('15%')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_alamat')
                    ->label('Alamat')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('client_telp')
                    ->label('Nomor Telepon')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_jns')
                    ->label('Jenis Relasi')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                SelectFilter::make('client_jns')
                    ->label('Jenis Relasi')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'tendik' => 'Tenaga Kependidikan',
                        'dosen' => 'Dosen',
                        'umum' => 'Umum',
                    ]),
=======
                TextColumn::make('client_jns')->label('Jenis Pengguna')->searchable(),
                TextColumn::make('client_id')->label('Tanda Pengenal')->searchable(),
            ])
            ->filters([
                //
>>>>>>> bc8ba68e58f533b1eca4eb76323b716188b23c10
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
