<?php 

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\Alignment;

class ViewComment extends ViewRecord
{
    protected static string $resource = CommentResource::class;
    

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->icon('heroicon-s-pencil-square')
                ->label('Edit Comment'),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
            ])
         
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Post Details')
                    
                    ->schema([
                    TextEntry::make('post.title')
                        ->label('')
                        ->size('lg')
                        ->color('primary'),
                       
                    TextEntry::make('post.body')
                        ->label('')
                        ->size('md')
                      
                        
                ])
                    ->columns(1),

                Section::make('Comments')

                    ->description('Ari na ang comment mo epal sa post lantaw mo gd')
                    ->schema([
                        // RepeatableEntry::make('post.comments')
                        //     ->label('')
                        //     ->schema([
                                TextEntry::make('comment_body')
                                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                                    ->iconColor('primary')
                                    ->label('Comment')
                                    ->size('md')
                            // ])
                    ])
                    ->columns(2),
            ]);
    }
}