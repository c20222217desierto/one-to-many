<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use App\Models\Comment;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\Markdown;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CommentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommentResource\RelationManagers;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    
    protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('post_id')
            ->label('Post')
            ->options(Post::pluck('title', 'id'))
            ->searchable()
            ->createOptionForm([
                TextInput::make('title')
                    ->label('New Post Title')

                    //ari e unique ya imo post kung ma create
                    // ->rules('unique:posts,title')

                    // ari naman ya kung ma edit ka sang post
                    ->unique(ignoreRecord: true)
                    ->required(),
                MarkdownEditor::make('body')
                    ->required()
                    ->rules('unique:posts,body')
                    ->unique(ignoreRecord: true)
                    ->label('New Post Body'),
                  
            ])
            ->createOptionUsing(function (array $data) {
                // Create a new post and return its ID
                $post = Post::create([
                    'title' => $data['title'],
                    'body' => $data['body'],
                ]);


                
                return $post->id;
            })
            ->columnSpanFull()
            ->required(),
        

            // Repeater::make('post.comments')
            //     ->label('Comments')
            //     ->schema([
                    MarkdownEditor::make('comment_body')
                        ->label('Comment')
                        ->required()
                        ->columnSpanFull()
                        ->maxLength(255),
        //         ])
        //         ->collapsible()
        //         ->columnSpanFull()
                
        //         ->createItemButtonLabel('Add New Comment'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->label('Post Title')
                    ->searchable(),
                TextColumn::make('comment_body')
                    ->label('Comment')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Posted On')
                    ->sortable()
                    ->color('primary')
                    ->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
            'view' => Pages\ViewComment::route('/{record}'),
        ];
    }
}
